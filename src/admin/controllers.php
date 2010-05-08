<?php
require_once 'o/admin/include/function/admin_finances.php';

function admin_page($id)
{
    $user = fetch_if_you_can($id);

    $groups = Groupe::all();
    $group_summary = Groupe::summary();

	$finances = admin_finances($dbh = get_dbh(), $_COOKIE['deb_lang']);
    $config = Config::get_config();

    // a strange bug insert a row on empty group list
    // so this clear the array if there are no groups
    if($group_summary['nb_groups'] == 0)
    {
        $groups = array();
    }

    $buses = Bus::getBuses();
    $bus_summary = Bus::summary();

    return render('admin_page.tpl',compact('user','groups','group_summary','buses','bus_summary','finances','config'));
}

function edit($id)
{
    $user = fetch_if_you_can($id);

    if(is_post())
    {
        $user = User::update_from_post($user);

        if($user->isValid())
        {
            $user->save();
            return redirect('/organisateur/'.$user->id);
        } else {
            $errors = array();
            $errors['user'] = get_errors($user);
        }
    }

    return render('admin_edit.tpl',compact('user','errors'));
}

function fetch_if_you_can($id)
{
    i_am_logged();
    i_can_edit_that('Admin',$id);
    $user = fetch_or_404('User',$id);
    if(!$user->isAdmin()) throw new NotFoundException();
    return $user;
}
