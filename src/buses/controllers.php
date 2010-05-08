<?php

function add($group_id)
{
    i_am_logged();
    $logged = get_logged_user();

    $group = fetch_if_you_can($group_id);

    $bus = new Bus();
    $bus->Chief = new User();

    $group->Buses[] = $bus;

    if(is_post())
    {
        $bus->fromArray($_POST['bus']);
        $bus->Chief->type = 'B';
        $bus->Chief->inviter = $logged->id;
        $bus->Chief->invite_email = $bus->Chief->login_email;
        //$bus->Chief = $bus->Chief;
        $bus->Chief->Groupe = $group;

        if($bus->isValid(true)){
            // save chief first cause we need his id
            $bus->Chief->save();
            // same for bus
            $bus->save();
            // a chief is a member of his bus
            $bus->Chief->Bus = $bus;
            $bus->save();

            $bus->Chief->invite();
            return redirect('/mypage');
        }
        else
        {
            $errors = array();
            $errors['bus'] = get_errors($bus);
            $errors['bus']['Chief'] = get_errors($bus->Chief);
        }
    }
    return render('bus_add.tpl',compact('bus','user','errors'));
}

function bus_page($id)
{
    i_am_logged();
    $logged = get_logged_user();

    $bus = fetch_or_404('Bus',$id);

    $user = $bus->Chief;
    $group_chief = $bus->Groupe->Chief;
    $group = $bus->Groupe;

    $dbh = get_dbh();

    $couples = User::getCoupleInBus($bus->id);

	//print_r($couples);

    foreach ($couples as $key => $value){

    	$str = '<select name="couple['.$value[0]['d__fk_couple_id'].']">';
			for ($i=1;$i<=count($couples);$i++){
				if ($i == $value[0]['c__place_in_bus']){
					$str .= '<option value="'.$i.'" selected="selected">'.$i;
				} else {
					$str .= '<option value="'.$i.'">'.$i;
				}

			}
		$str .= '</select>';

		$value['select'] = $str;
		$couples[$key] = $value;
    }


    $compteurs = array();
    $compteurs['confirmes'] = User::countBusMembresConfirmed($id);
    $compteurs['disponibles'] = $bus->size - $compteurs['confirmes'];
    // force the user type in case this user is a group chief
    // (plz do not save it !!)
    $user->type = 'B';
    return render("bus_page.tpl",compact('user','group_chief','group','couples','bus','bus_summary','compteurs'));
}

function edit($id)
{
    $bus = fetch_or_404('Bus',$id);
    i_am_logged();
    i_can_edit_that('Bus',$id);
    $user = $bus->Chief;
    $group_chief = $bus->Groupe->Chief;
    if(is_post())
    {
        $bus->fromArray($_POST['bus']);
        if($bus->isValid(true))
        {
            $bus->save();
            return redirect('/bus/'.$bus->id);
        }
        else
        {
            $errors = array();
            $errors['bus'] = get_errors($bus);
            $errors['bus']['Chief'] = get_errors($bus->Chief);
        }
    }

    // force the user type in case this user is a group chief
    // (plz do not save it !!)
    $user->type = 'B';
    return render('bus_edit.tpl',compact('bus','user','group_chief','errors'));

}

function update_couple_order($id){
	//die(print_r($_POST));
	$dbh = get_dbh();

	foreach ($_POST['couple'] as $key => $value){
		$dbh->execute("UPDATE couple SET place_in_bus = '".$value."' WHERE id='".$key."'");
	}

	bus_page($id);
}

function fetch_if_you_can($id)
{
    i_am_logged();
    $group = fetch_or_404('Groupe',$id);
    i_can_edit_that('Groupe',$id);
    return $group;
}
