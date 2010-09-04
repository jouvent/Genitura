<?php

function fetch_or_404($class, $id)
{
    $obj = call_user_func(array($class ,'fetch'),$id);
    if(!$obj){ throw new NotFoundException(); }
    return $obj;
}

function i_am_logged()
{
    $session = get_session();
    if(!$session->islogged()){ throw new LoginRequiredException(); }
    return true;
}

function i_can_edit_that($class, $id)
{
    $user = get_logged_user();

    // Admins can access you all
    if($user->type == "A")
    { return true; }

    switch($class)
    {
    case 'Group':
        // only group chief can modify his group
        if($user->GroupChiefOf->id == $id)
        { return true; }
        break;
    case 'Bus':
        // bus chief can modify his bus
        if($user->BusChiefOf->bus_id == $id)
        { return true; }
        // group chief can modify the busses in his group
        $bus = Bus::fetch($id);
        if($user->id == $bus->Group->Chief->id)
        { return true; }
        break;
    case 'User':
        // user can modify himself
        if($user->id == $id)
        { return true; }
        $target_user = User::fetch($id);
        // bus chief can modify users in his bus
        if($user->BusChiefOf->bus_id == $target_user->Bus->bus_id)
        { return true; }
        // group chief can modify users in his group
        if($user->GroupChiefOf->id == $target_user->Group->id)
        { return true; }
    }
    throw new AccessDeniedException();
}
