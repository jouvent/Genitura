<?php

function add()
{
    i_am_logged();
    i_can_edit_that('Groupe',0);
    $logged = get_logged_user();

    $group = new Groupe();
    $group->Chief = new User();
    $group->Buses[] = new Bus();

    if(is_post())
    {
        $group->fromArray($_POST['group']);
        $group->Chief->type = 'G';
        $group->Chief->inviter = $logged->id;
        $group->Chief->invite_email = $group->Chief->login_email;
        $group->Buses[0]->name = $group->Chief->name;
        $group->Buses[0]->Chief = $group->Chief;

        if($group->isValid(true)){
            // save chief first cause we need his id
            $group->Chief->save();
            // same for group
            $group->save();
            // a chief is a member of his group
            $group->Chief->Groupe = $group;
            $group->Chief->Bus = $group->Buses[0];
            $group->save();

            $group->Chief->invite();

            return redirect('/mypage');
        }
        else 
        {
            $errors = array();
            $errors['group'] = get_errors($group);
            $errors['group']['Chief'] = get_errors($group->Chief);
            //$errors['group']['buses[0]'] = get_errors($group->Buses[0]);
        }
    }
    return render('group_add.tpl',compact('group','user','errors'));
}

function edit($id)
{
    $group = fetch_if_you_can($id);

    $user = $group->Chief;
    $main_bus_id = $user->Bus->id;

    if(is_post())
    {
        $group->fromArray($_POST['group']);

        if($group->isValid(true))
        {
            $group->save();
            return redirect('/group/'.$group->id);
        } else {
            $errors = array();
            $errors['group'] = get_errors($group);
            $errors['group']['Chief'] = get_errors($group->Chief);
        }
    }

    return render('group_edit.tpl',compact('group','user','main_bus_id','errors'));
}


function group_page($id)
{
    $group = fetch_if_you_can($id);

    $user = $group->Chief;
    $buses = Bus::getBusesOfGroupe($id);

    $bus_summary = Bus::summary($id);
    $main_bus_id = $user->Bus->id;

    $compteurs = array();
    $compteurs['bus'] = count($buses);
    $compteurs['places'] = $group->size;
    $compteurs['confirmes'] = User::countGroupeMembresConfirmed($id);
    $compteurs['disponibles'] = $group->size - $compteurs['confirmes'];

    echo " "; // WTF !!
    return render("group_page.tpl",compact('user','group','main_bus_id','buses','bus_summary','compteurs'));
}

function fetch_if_you_can($id)
{
    i_am_logged();
    $group = fetch_or_404('Groupe',$id);
    i_can_edit_that('Groupe',$id);
    return $group;
}
