<?php

function invitation_key()
{
    $refcode = $_GET['refcode'];
    if(is_post()){
		$refcode = $_POST['refcode'];
        $session = get_session();
        if($session->start_registration($refcode))
        {
            $user = get_logged_user();
            $user->invite_status = max($user->invite_status,1);
            $user->save();
            if($user->fk_paypal){
                return redirect('/registration/userinfo');
            }
            return redirect('/registration/tablee');
        } else {
            $errors = array();
            $errors['key'] = 1;
            $message = 'Invalid invitation code. Please check your entry.';
        }
    }
    return render('registration_key.tpl',compact('refcode','errors'));
}

function user_info()
{
    $session = get_session();
    if(!$session->isRegistering()) {
        return redirect('/registration');
    }
    $user = get_logged_user();
    if(is_post()) {
        $sex = $user->sex;
        $user = User::update_from_post($user);
        $user->setPassword( $_POST['password']);
        $valid_password = ($_POST['password'] == $_POST['confirmpassword']) && !empty($_POST['password']);

        $homosexual_couple = $user->sex == $sex;

        if(
            $user->isValid() &
            $valid_password &
            !$homosexual_couple
        ) {
            $user->invite_status = max($user->invite_status,4);
            $user->save();
            return redirect("/registration/completed");
        } else {
            $errors = array();
            $errors['user'] = get_errors($user);
            $errors['user']['password']['valid'] = (int) !$valid_password;
            $errors['user']['sex']['homosexual_couple'] = (int) $homosexual_couple;
        }
    }
    return render('registration_user_info.tpl',compact('user','errors'));
}

function user_tablee()
{
    $session = get_session();
    if(!$session->isRegistering()) {
        return redirect('/registration');
    }
    $user = get_logged_user();
    $friendship = $user->Couple->Friendship;
    if(count($friendship->Couples)>1){
        $friends = 'yes';
    }
    $friendship->Couples[0]->Users;
    $friendship->Couples[1]->Users;
    if(is_post()) {
        $friends = $_POST['friends'];
        $friendship->fromArray($_POST['friendship']);
        $user->setPassword( $_POST['password']);
        $valid_password = ($_POST['password'] == $_POST['confirmpassword']) && !empty($_POST['password']);

        $homosexual_couple = $user->sex == $friendship->Couples[0]->Users[1]->sex;

        if($friendship->table_nb >= 1 || $friends){
            $homosexual_couple_2 = $friendship->Couples[1]->Users[0]->sex == $friendship->Couples[1]->Users[1]->sex;
        } else {
            $friendship->Couples[1] = null;
        }
        foreach($friendship->Couples as $couple){
            foreach($couple->Users as $new_user){
                if(!$new_user->id){
                    $new_user->inviter = $user->id;
                    $new_user->invite_email = $new_user->login_email;
                }
            }
        }
        if(
            $friendship->isValid(true) &&
            $valid_password &&
            !$homosexual_couple&&
            !$homosexual_couple_2
        ) {
            $user->invite_status = max($user->invite_status,2);
            $friendship->save();
            return redirect("/registration/paypal");
        } else {
            $errors = array('friendship'=>array('Couples'=>array(0=>array(),1=>array())));
            $errors['friendship']['Couples'][0] = get_errors($friendship->Couples[0]);
            $errors['friendship']['Couples'][0]['homosexual_couple'] = (int) $homosexual_couple;
            $errors['friendship']['Couples'][0]['Users'] = array();
            $errors['friendship']['Couples'][0]['Users'][0] = get_errors($user);
            $errors['friendship']['Couples'][0]['Users'][0]['password']['valid'] = (int) !$valid_password;
            $errors['friendship']['Couples'][0]['Users'][1] = get_errors($friendship->Couples[0]->Users[1]);
            if($friends){
                $errors['friendship']['Couples'][1] = get_errors($friendship->Couples[1]);
                $errors['friendship']['Couples'][0]['homosexual_couple'] = (int) $homosexual_couple_2;
                $errors['friendship']['Couples'][1]['Users'] = array();
                $errors['friendship']['Couples'][1]['Users'][0] = get_errors($friendship->Couples[1]->Users[0]);
                $errors['friendship']['Couples'][1]['Users'][1] = get_errors($friendship->Couples[1]->Users[1]);
            }
        echo '<pre>';
        print_r($errors);
        echo '</pre>';
        }
    }
    return render('registration_tablee.tpl',compact('user','friendship','errors','friends'));
}

function user_friends()
{
    $session = get_session();
    if(!$session->isRegistering()) {
        return redirect('/registration');
    }
    $user = get_logged_user();
    $couple = User::getOtherCouple($user->id);
    $friend_1 = $couple->Users[0];
    $friend_2 = $couple->Users[1];
    if($couple){
        $friends = 'yes';
    }
    if(is_post()) {
        $friends = $_POST['friends'];
        if($friends){
            $friend_1 = User::update_from_post($friend_1,'friend_1_');
            $friend_1->inviter = $user->id;
            $friend_1->invite_email = $friend_1->login_email;
            $friend_2 = User::update_from_post($friend_2,'friend_2_');
            $friend_2->inviter = $user->id;
            $friend_2->invite_email = $friend_2->login_email;

            $homosexual_couple = $friend_1->sex == $friend_2->sex;

            if(
                $friend_1->isValid() &
                $friend_2->isValid() &
                !$homosexual_couple
            ) {
                $friend_1->save();
                $friend_2->save();

                $friend_1->Couple = $couple;
                $friend_2->Couple = $couple;
                $friend_1->Couple->Users[] = $friend_1;
                $friend_1->Couple->Users[] = $friend_2;
                $friend_1->Couple->save();

                $friend_1->Couple = $couple;
                $friend_2->Couple = $couple;
                $friend_1->save();
                $friend_2->save();

                $user->Couple->Friendship->save();

                $user->Couple->Friendship->Couples[] = $user->Couple;
                $user->Couple->Friendship->Couples[] = $friend_1->Couple;

                $user->Couple->Friendship->save();

                $user->invite_status = max($user->invite_status, 3);
                $user->save();

                return redirect("/registration/paypal");
            } else {
            $errors = array();
            $errors['friend_1'] = get_errors($user);
            $errors['friend_1']['sex']['homosexual_couple'] = (int) $homosexual_couple;

            $errors['friend_2'] = get_errors($couple);
            }
        } else {
            $couple->Users[0]->delete();
            $couple->Users[1]->delete();
            $couple->delete();
            $user->invite_status = max($user->invite_status, 3);
            $user->save();
            return redirect('/registration/paypal');
        }
    }
    return render('registration_friends.tpl',compact('friend_1','friend_2','friends','errors'));
}

function registration_paypal()
{

    $session = get_session();
    if(!$session->isRegistering()) {
        return redirect('/registration');
    }
    $user = get_logged_user();

    $nb_tables = ((int) count($user->Couple->Friendship->Couples));

    $paypal_code = ($nb_tables==2)?('2 personnes'):('4 personnes');

	$lang = $_COOKIE['deb_lang'];

	if($lang == 'en'){
		$words = array('table', 'chair');
	} else {
		$words = array('table', 'chaise');
	}

    $item_array = array(0=>'', 1=>'');
    $have_chairs = false;
    $have_tables = false;
    $chairs = 0;
    $tables = 0;
/*    $table_select = '<select name="table_select">
    				 <option value="0">0</option>
					 <option value="1">1</option>
					 <option value="2">2</option>
					 </select>';
    $chair_select = '<select name="chair_select">
					 <option value="0">0</option>
					 <option value="1">1</option>
					 <option value="2">2</option>
					 <option value="3">3</option>
					 <option value="4">4</option>
					 </select>';
*/					 
    if (isset($_GET['tables']) && isset($_GET['chairs']) && $_GET['tables'] > 0 && $_GET['chairs'] > 0){
    	$item_array[0] = '<input type="hidden" name="item_name_2" value="'.$words[0].'">
    					  <input type="hidden" name="amount_2" value="45.00">
    					  <input type="hidden" name="quantity_2" value="'.$_GET['tables'].'">';
    	$item_array[1] = '<input type="hidden" name="item_name_3" value="'.$words[1].'">
    					  <input type="hidden" name="amount_3" value="13.00">
    					  <input type="hidden" name="quantity_3" value="'.$_GET['chairs'].'">';
    	$have_chairs = true;
    	$have_tables = true;
    	$chairs = $_GET['chairs'];
    	$tables = $_GET['tables'];

    } else if (isset($_GET['tables']) && isset($_GET['chairs']) && $_GET['tables'] > 0 && $_GET['chairs'] <= 0){
    	$item_array[0] = '<input type="hidden" name="item_name_2" value="'.$words[0].'">
    					  <input type="hidden" name="amount_2" value="45.00">
    					  <input type="hidden" name="quantity_2" value="'.$_GET['tables'].'">';
    	$have_tables = true;
    	$tables = $_GET['tables'];
    } else if (isset($_GET['chairs']) && isset($_GET['tables']) && $_GET['chairs'] > 0 && $_GET['tables'] <= 0){
    	$item_array[0] = '<input type="hidden" name="item_name_2" value="'.$words[1].'">
    					  <input type="hidden" name="amount_2" value="13.00">
   						  <input type="hidden" name="quantity_2" value="'.$_GET['chairs'].'">';
   		$have_chairs = true;
    	$chairs = $_GET['chairs'];
   	}

   	$table_amount = number_format($tables * 45.00, 2);
   	$chair_amount = number_format($chairs * 13.00, 2);


    return render('registration_paypal.tpl',compact('nb_tables','paypal_code', 'item_array', 'have_chairs', 'have_tables', 'chairs', 'tables', 'chair_amount' ,'table_amount'));
}

function registration_paypal_fail(){

	return redirect('/registration');
}

function registration_paypal_success()
{

    $session = get_session();
    if(!$session->isRegistering()) {
        return redirect('/registration');
    }
    $user = get_logged_user();

    // TODO doit implementer ici, enregistrement dans registration payement
    $nb_tables = ((int) count($user->Couple->Friendship->Couples));
    $dbh = get_dbh();
    $dbh->execute('INSERT INTO registration_payement SET fk_user_id='.$user->id.', nb_tables='.$nb_tables.', paypal_id="'.$paypal_id.'"');
    $user->save();

    return redirect('/registration/fin');
}

function registration_fin()
{

    $session = get_session();
    if(!$session->isRegistering()) {
        return redirect('/registration');
    }
    $user = get_logged_user();


    $user = get_logged_user();
    $user->invite_status = max($user->invite_status, 4);
    $user->registration_date = new Doctrine_Expression('NOW()');
    $user->save();

    $session = get_session();
    $session->logout();

    $bus_chief = $user->Bus->Chief;
    $group_chief = $user->Group->Chief;

    return render('registration_fin.tpl',compact('bus_chief','group_chief'));
}

