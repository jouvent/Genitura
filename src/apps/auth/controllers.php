<?php

function login_user() {
    $data = new array();
    if(is_post()) {
        $session =  get_session();

        if($session->login($_POST['USERNAME'], $_POST['PASSWORD'])) {
            return redirect('/');
        }
        $data['error'] = "Invalid email and/or password. Please check your entry.";
    }
    return render('login.tpl',$data);
}

function logout_user() {
    $session =  get_session();
    $session->logout();
    return redirect('/');
}
