<?php

function invitation_csv(){
    i_am_logged();

	$msgNum = 0;

	// set strings
	$lang = $_COOKIE['deb_lang'];
	if( isset($_POST['submit']) ) {

        $inviter = get_logged_user();

        $group_id = $_POST['group'];
        $bus_id = $_POST['bus'];

        $is_VIP = (int) isset($_POST['VIP']);

        if(!is_numeric($group_id)){
            $group_id = null;
        }
        if(!is_numeric($bus_id)){
            $bus_id = null;
        }
		ini_set('auto_detect_line_endings', 1);

        $file = upload_file('uploadedfile',array('csv'));
        if( $file ) {

            // read each line into an array
            $csvUsersArray = file($file);

            $duplicateInvitedFound = false;
            $duplicateBlackListedFound = false;

            // Loop through the array
            foreach ($csvUsersArray as $arrayIndex => $oneUser) {

                // the DEB admins use Mac-s so convert from Mac to UTF-8
                $oneUser = iconv( 'macintosh', 'UTF-8', $oneUser);

                $user = new User();

                // get the user info
                list($name, $numPersons, $tel, $mobile, $groupName, $email) = explode(',', $oneUser);
                $user->name = $name;
                $user->invite_email = trim($email);
                $user->login_email = trim($email);
                $user->tel1 = $tel;
                $user->tel2 = $mobile;
                $user->fk_group_id = $group_id;
                $user->fk_bus_id = $bus_id;
                $user->is_vip = $is_VIP;
                $user->inviter = $inviter->id;

                // bad default..
                $user->sex = 'm';
                $user->address = '';

                try{
                    if($_POST['action'] == 'invite'){
                        $user->invite();
                    } else if ($_POST['action'] == 'blacklist'){
                        $user->blacklist();
                    }
                    $saved++;
                }catch(Exception $e){
                    $user->mapValue('errors',get_errors($user));
                    $invalid_users[] = $user;
                }
            }
            $msgNum = 3; //users upload was successful
            $msg = $msg3;
        } else {
			$msgNum = 1;//invalid file type (not csv)
			$msg = $msg1;
		}
	}

    $groups_select = new select_Class("group","groups_$lang");
    $groups_select->set_default($_GET['group']);
    $groups_select = $groups_select->get_html();

    $bus_select = new select_Class("bus","bus_$lang");
    $bus_select->set_default($_GET['bus']);
    $bus_select = $bus_select->get_html();

    return render('invite_csv.tpl',compact('bus_select','groups_select','invalid_users','saved'));
}
