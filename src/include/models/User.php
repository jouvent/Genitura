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
    public function setUp() {
        parent::setUP();
        $this->hasMutator('password', 'setPassword');
    }

    public function setPassword($password) {
        $this->_set('password', md5($password));
    }

    static function fetch($id)
    {
        return Doctrine::getTable('User')->find($id);
    }

    static function getByCredential($username, $password) {
        $q = Doctrine_Query::create()
            ->from('User u')
            ->where('u.username = ?', $username)
            ->andWhere('u.password = ?', md5($password))
            ->andWhere('u.is_deleted = 0');
        return $q->fetchOne();
    }
}
