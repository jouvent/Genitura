<?php

require_once 'o/include/function/basket_summary.php';

function view_user($id){
    $user = User::fetch($id);
    if(!$user) throw new NotFoundException();

    $session = get_session();
    if(!$session->logged)
    {
        return redirect('/');
    }
    if($user->type == 'A')
    {
        return redirect('/organisateur/'.$user->id);
    }
    if($user->type == 'G')
    {
        return redirect('/group/'.$user->Groupe->id);
    }
    if($user->type == 'B')
    {
        return redirect('/bus/'.$user->Bus->bus_id);
    }
    return redirect('/invite/'.$user->id);
}

function my_page(){
    $session = get_session();
    if(!$session->logged)
    {
        return redirect('/');
    }
    $me = $session->whoAMI();
    return view_user($me[0]);
}

function view_invite($user_id)
{

    $user = User::fetch($user_id);
    if(!$user) throw new NotFoundException();
    $basket = basket_summary($dbh = get_dbh(), $user_id, $_COOKIE['lang']);
    $couple = $user->Couple;
    $couples = $couple->Friendship->Couples;
    $in_couple = User::getCouple($user->id);

    if($couples[0]->id == $couple->id){
        $friends = $couples[1];
    } else {
        $friends = $couples[0];
    }
    $friend_1 = $friends->Users[0];
    $friend_2 = $friends->Users[1];

    $group_chief = $user->Groupe->Chief;
    $bus_chief = $user->Bus->Chief;

    $has_friends = $couples[1]->exists();

    $basket_simple = basket_simple($user_id);
    $friend_basket_simple = basket_simple($friend1->id);

    $dbh = get_dbh();
    $stmt = $dbh->execute("SELECT fk_user_id FROM registration_payement WHERE paypal_id = (SELECT fk_paypal FROM user WHERE id = '".$user_id."')");
    list($fk_user_id) = $stmt->fetch_array();

    if ($fk_user_id == $user_id){
    	$invite_payeur = true;
    	$inv_pay = User::fetch($fk_user_id);
    } else {
    	$invite_payeur = false;
    	$inv_pay = User::fetch($fk_user_id);
    }

    $inviter = '';
    if ($user->previous_deb == 'yes'){
    	$inviter = 'prev';
    } else if ($user->inviter != ''){
    	$inviter = User::fetch($user->inviter);
    }

    return render('invite_page.tpl',compact('user','basket','couple','in_couple','group_chief','bus_chief','friends','friend_1','friend_2','has_friends', 'basket_simple', 'invite_payeur', 'inv_pay', 'inviter'));
}

function edit_invite($id)
{
    i_am_logged();
    $user = fetch_or_404('User',$id);

    $couple = $user->Couple;
    $couples = $couple->Friendship->Couples;
    $has_friends = $couples[1]->exists();
    $in_couple = User::getCouple($user->id);


    if($couples[0]->id == $couple->id){
        $friends = $couples[1];
    } else {
        $friends = $couples[0];
    }
    $friend_1 = $friends->Users[0];
    $friend_2 = $friends->Users[1];

    $has_friends = $couples[1]->exists();

    if(is_post()){
        $user->fromArray($_POST);
        $user->fk_group_id = $_POST['s_groups'];
        if(!is_numeric($user->fk_group_id)) $user->fk_group_id = null;
        $user->fk_bus_id = $_POST['s_buses'];
        if(!is_numeric($user->fk_bus_id)) $user->Bus = null;
        if($user->isValid()){
            $user->save();
            return redirect('/user/page/'.$user->id);
        } else {
            $errors = array();
            $errors['user'] = get_errors($user);
            //print_r($errors);
        }
    }

    //if logged person is an admin, organizer, group chief or bus chief, we give them full access
    //normal users are not permitted to modify name, email, group and bus
    $session = get_session();
    if ($session->user_type != 'S'){
    	if ($has_friends){
     	 	return render('invite_edit.tpl',compact('user','errors', 'couple','in_couple', 'friends','friend_1','friend_2','has_friends'));
    	} else {
    		return render('invite_edit.tpl',compact('user','errors', 'couple','in_couple'));
    	}

    } else {
    	if ($has_friends){
    		 return render('invite_own_edit.tpl',compact('user','errors', 'couple','in_couple', 'friends','friend_1','friend_2','has_friends'));
    	} else {
    		 return render('invite_own_edit.tpl',compact('user','errors', 'couple','in_couple'));
    	}

    }


}

/* lists */

function user_by_group($group_id)
{
    $group = fetch_or_404('Groupe',$group_id);

    $users = $group->Users;
    foreach($users as $user){
        $user->Groupe;
        $user->Bus;
    }

    return render('group_user_list.tpl',compact('group','users'));
}

function user_by_bus($bus_id)
{
    $bus = Bus::fetch($bus_id);
    if(!$bus) throw new NotFoundException();

    $users = User::getBusMembers($bus_id);

    return render('bus_user_list.tpl',compact('bus','users'));
}

function search()
{
    i_am_logged();
    $user = get_logged_user();
    $groups = Groupe::groupsICanSee($user);
    $buses = Bus::busICanSee($user);
    $users = User::search($_GET);
    $s_grp_id = $_GET['s_groups'];
    $s_bus_id = $_GET['s_buses'];
    $search = $_GET['search'];
    return render('search_user.tpl',compact('users','groups','buses','s_grp_id','s_bus_id','search'));
}

