<?php
require_once 'invitation_csv.php';

function invite_user()
{
    i_am_logged();
    $inviter = get_logged_user();
    $groups = Groupe::groupsICanSee($inviter);
    $buses = Bus::busICanSee($inviter);

    if(is_post())
    {
        $user = User::create_from_post();
        $user->type = 'S';
        $groupe = Doctrine::getTable('Groupe')->find($_POST['s_groups']);
        if($groupe) $user->Groupe = $groupe;
        $bus = Doctrine::getTable('Bus')->find($_POST['s_buses']);
        if($bus) $user->Bus = $bus;

        if($user->isValid() & $inviter->canInvite())
        {
            $user->save();
            $user->invite();
            $inviter->useInvite();
            return redirect("/user/inviter/".$user->inviter);
        } else {
            $errors = array();
            $errors['user'] = get_errors($user);
            $errors['inviter']['can_invite'] = (int) !$inviter->canInvite();
        }
    } else {
            return redirect('/mypage');
    }


    // for select
    $s_grp_id = $_POST['s_groups'];
    $s_bus_id = $_POST['s_buses'];
    return render('invite_form.tpl',compact('user','groups','buses','s_grp_id','s_bus_id','errors'));
}

function user_by_inviter($id)
{
    i_am_logged();
    i_can_edit_that('User',$id);
    $inviter = fetch_or_404('User',$id);

    $users = User::getInvitedBy($id);
    $inviter->mapValue('invite_count',count($users));

    $groups = Groupe::groupsICanSee($inviter);
    $buses = Bus::busICanSee($inviter);

    $s_grp_id = $inviter->fk_group_id;
    $s_bus_id = $inviter->fk_bus_id;

    return render('invite_user_list.tpl',compact('inviter','users','groups','buses','s_grp_id','s_bus_id'));
}
