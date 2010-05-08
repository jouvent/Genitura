<?php

function login_user() {
    if(is_post()) {
        $session =  get_session();

        if($session->login($_POST['USERNAME'], $_POST['PASSWORD'])) {
            return redirect('/');
        }
        $error_message = "Invalid email and/or password. Please check your entry.";
    }
    return render('login.tpl',array('error'=>$error_message));
}

function logout_user() {
    $session =  get_session();
    $session->logout();
    return redirect('/');
}
