<?php
function render($template_name, $variables = array()){
    $lang = $_COOKIE['deb_lang'];
    if(!$lang){ $lang = 'fr';}
    $h2o = new h2o("templates/$template_name");
    //$session = get_session();
    //$logged = get_logged_user();
    $globals = array(
        'lang' => $_COOKIE['deb_lang'], 
        'IMG_URL' => IMG_URL,
        'isloged' => $session->logged,
        'logged' => $logged,
    );
    //print_r($session);
    return $h2o->render(array_merge($globals,$variables));
}
