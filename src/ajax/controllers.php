<?php

function group_bus_navigation(){
    i_am_logged();
    $user = get_logged_user();     
    if($user->isAdmin()){
        $groups = Group::all();
        $buses = Bus::oneInCollection(0);
    } else {
        $groups = Group::oneInCollection($user->fk_group_id);
        if($user->isGroupChief()){
            $buses = $user->Group->Buses;
        } else {
            $buses = Bus::oneInCollection($user->fk_bus_id);
        }
    }
    return render('snipp/group_bus_select.tpl',compact('groups','buses'));
}
