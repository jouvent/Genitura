<?php

/**
 * User
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class User extends BaseUser
{
    public function setUp(){
        parent::setUP();
        $this->hasMutator('password', 'setPassword');
        $this->hasAccessor('email','getEmail');
    }

    public function setPassword($password)
    {
        $this->_set('password', md5($password));
    }

    public function getEmail(){
        return 'patate';
    }


    public function isAdmin()
    {
        return $this->type == 'A';
    }

    public function isChief()
    {
        return $this->type == 'A' || $this->type == 'G' || $this->type == 'B';
    }

    public function isGroupeChief()
    {
        return $this->type == 'G';
    }

    public function isBusChief()
    {
        return $this->type == 'G' || $this->type == 'B';
    }

    public function canInvite()
    {
        return $this->invite_quotas >= 4 || $this->invite_quotas == -1;
    }

    public function useInvite()
    {
        if($this->invite_quotas != -1)
        {
            $this->invite_quotas -= 4;
            return $this->save();
        }
    }

    public function invite()
    {
        $this->Couple->save();
        $this->Couple->Friendship->Payeur = $this;
        $this->Couple->Friendship->invitation_date = new Doctrine_Expression('NOW()');
        $this->Couple->Friendship->save();
        $this->Couple->Friendship->Couples[] = $this->Couple;
        $this->Couple->Friendship->save();


        if($this->Groupe){ $this->Couple->Friendship->Groupe = $this->Groupe;}
        else {$this->Groupe = null;}
        if($this->Bus){ $this->Couple->Friendship->Bus = $this->Bus;}
        else {$this->Bus = null;}


        if($this->Groupe){ $this->Couple->Groupe = $this->Groupe;}
        else {$this->Groupe = null;}
        if($this->Bus){ $this->Couple->Bus = $this->Bus;}
        else {$this->Bus = null;}
        $this->save();

        $this->_set('invite_status', -1);
        $this->_set('invite_key', create_invite_key($this->id));
        $this->save();
    }

    static function email_exist($email, $id=null)
    {
        $q = Doctrine_Query::create()
                ->select('COUNT(u.id) as count')
                ->from('User u')
                ->where('u.login_email = ?', $email);
        if($id){
            $q->andWhere('u.id != ?', $id);
        }
        //echo $q->getSqlQuery();
        $count =  $q->fetchOne()->toArray();
        return $count['count'] >= 1;
    }

    static function fetch($id)
    {
        return Doctrine::getTable('User')->find($id);
    }

    static function getBusMembers($id)
    {
        $q = Doctrine_Query::create()
                ->from('User u')
                ->leftJoin('u.Bus b')
                ->leftJoin('u.Groupe g')
                ->where('b.id = ?', $id);
        //echo $q->getSqlQuery();
        return $q->execute();
    }

    static function getCoupleInBus($id)
    {
        $dbh = get_dbh();

        $q = "SELECT d.id AS d__id, d.invite_key AS d__invite_key, d.inviter AS d__inviter,
            d.recommended_by AS d__recommended_by, d.previous_deb AS d__previous_deb,
            d.invite_quotas AS d__invite_quotas, d.invite_email AS d__invite_email,
            d.invite_status AS d__invite_status, d.sex AS d__sex, d.name AS d__name,
            d.address AS d__address, d.tel1 AS d__tel1, d.tel2 AS d__tel2,
            d.type AS d__type, d.login_email AS d__login_email, d.password AS d__password,
            d.is_admin AS d__is_admin, d.is_vip AS d__is_vip, d.is_blacklisted AS d__is_blacklisted,
            d.fk_couple_id AS d__fk_couple_id, d.fk_paypal AS d__fk_paypal,
            d.fk_group_id AS d__fk_group_id, d.fk_bus_id AS d__fk_bus_id, b.id AS b__bus_id,
            b.name AS b__bus_name, b.size AS b__size, b.bus_chief_id AS b__bus_chief_id,
            b.fk_group_id AS b__fk_group_id, c.id AS c__id, c.fk_paying_id AS c__fk_paying_id,
            c.own_table AS c__own_table, c.fk_friendship_id AS c__fk_friendship_id, c.place_in_bus AS c__place_in_bus
            FROM user d
            LEFT JOIN bus b ON d.fk_bus_id = b.id
            LEFT JOIN couple c ON d.fk_couple_id = c.id
            WHERE (
                b.id =1
            )
            ORDER BY c__place_in_bus";
        $sql = $dbh->execute($q);
        $couples = array();
        while($row = $sql->fetch_assoc())
        {
            if(!isset($couples[$row['c__id']]))
            {
                $couples[$row['c__id']] = array();
                $couples[$row['c__id']]['id'] = $row['c__id'];
            }
            $couples[$row['c__id']][] = $row;
        }
        return $couples;

    }

    static function countGroupeMembresConfirmed($id)
    {
        $q = Doctrine_Query::create()
                ->select('COUNT(u.id) as cnt')
                ->from('User u')
                ->leftJoin('u.Groupe g')
                ->where('g.id = ?', $id)
                ->andWhere('u.invite_status > 3');
        $result = $q->fetchOne()->toArray();
        //echo $q->getSqlQuery();
        return $result['cnt'];
    }

    static function countBusMembresConfirmed($id)
    {
        $q = Doctrine_Query::create()
                ->select('COUNT(u.id) as cnt')
                ->from('User u')
                ->leftJoin('u.Bus b')
                ->leftJoin('u.Groupe g')
                ->where('b.id = ?', $id)
                ->andWhere('u.invite_status > 3');
        $result = $q->fetchOne()->toArray();
        //echo $q->getSqlQuery();
        return $result['cnt'];
    }

    static function getInvitedBy($id)
    {
        $q = Doctrine_Query::create()
                ->from('User u')
                ->leftJoin('u.Bus b')
                ->leftJoin('u.Groupe g')
                ->where('u.inviter = ?', $id);
        //echo $q->getSqlQuery();
        return $q->execute();
    }

    static function allActive()
    {
        $q = Doctrine_Query::create()
                ->from('User u')
                ->where('u.invite_status => 4')
                ->andWhere('u.is_blacklisted = 0');
        //echo $q->getSqlQuery();
        return $q->execute();

    }

    static function update_from_post(User $user, $prefix = 'user_')
    {
        $user->sex = $_POST[$prefix.'sex'];
        $user->name = $_POST[$prefix.'name'];
        $user->address = $_POST[$prefix.'address'];
        $user->tel1 = $_POST[$prefix.'tel1'];
        $user->tel2 = $_POST[$prefix.'tel2'];
        $user->login_email = $_POST[$prefix.'login_email'];
        if(!empty($_POST[$prefix.'invite_quotas']))
        {
            $user->invite_quotas = $_POST[$prefix.'invite_quotas'];
        }
        return $user;
    }

    static function create_from_post($prefix = 'user_')
    {
        $session = get_session();

        $user = new User();
        $user->inviter = $session->user_id;
        $user->invite_email = $_POST[$prefix.'login_email'];
        return User::update_from_post($user, $prefix);
    }

    static function getCouple($id)
    {
        // if the user doesn't have a table create it
        $user = User::fetch($id);
        $table = $user->Couple;
        $table->Users[] = $user;
        $user->Couple->save();

        // if the mate exist, find it
        if(count($table->Users) >1 ) {
            foreach($table->Users as $couple){
                if($couple->id != $id){
                    return $couple;
                }
            }
        }
        // if the user is alone at his table, create a new user
        $couple = new User();
        $couple->inviter = $id;
        $table->Users[] = $couple;
        return $couple;
    }
    static function getOtherCouple($id)
    {
        // if the user doesn't have a friendship create it
        $user = User::fetch($id);
        $table = $user->Couple;
        $friends = $table->Friendship;
        $friends->Couples[] = $table;
        $friends->save();

        // if the second table exist, find it
        if(count($friends->Couples->toArray()) >1 ) {
            foreach($friends->Couples as $couple){
                if($couple->id != $table->id){
                    return $couple;
                }
            }
        }
        // if the table is alone in the friendship, create a new table
        $couple = new Couple();
        $friends->Couples[] = $couple;
        return $couple;
    }

    static function getFriends($id)
    {
    }

    static function search($data)
    {
        $q = Doctrine_Query::create()
                ->from('User u')
                ->leftJoin('u.Bus b')
                ->leftJoin('u.Groupe g')
                ->where('1 = 1');
        if(is_numeric($data['s_groups'])){
            $q->andWhere('g.id = ?',$data['s_groups']);
        } else if ($data['s_groups'] === 'NA') {
            $q->andWhere('u.fk_group_id is null');
        }
        if(is_numeric($data['s_buses'])){
            $q->andWhere('b.id = ?',$data['s_buses']);
        } else if ($data['s_buses'] === 'NA') {
            $q->andWhere('u.fk_bus_id is null');
        }
        if($data['search'])
        {
            $search = addslashes($data['search']);
            $q->andWhere('u.name LIKE ? OR u.login_email LIKE ? OR u.invite_email LIKE ? ',array("%$search%","%$search%","%$search%"));
        }
        //$q->where('u.invite_status => 4')
        //$q->andWhere('u.is_blacklisted = 0');
        //echo $q->getSqlQuery();
        return $q->execute();
    }
}
