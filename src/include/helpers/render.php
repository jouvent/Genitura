<?php
function render($template_name, $variables = array()){
    if(!isset($_COOKIE['lang'])){
        $lang = 'fr';
    } else {
        $lang = $_COOKIE['lang'];
    }
    $h2o = new h2o("templates/$template_name",array(
    'php-i18n' => array(
        'locale' => $lang,
        'charset' => 'UTF-8',
        'gettext_path' => '/usr/bin/',
        //'extract_message' => true,
        //'compile_message' => true,
        'tmp_dir' => '/tmp/',
    )));
    $session = get_session();
    $logged = $session->get_logged_user();
    $globals = array(
        'lang' => $lang, 
        'IMG_URL' => IMG_URL,
        'islogged' => $session->isLogged(),
        'logged' => $logged,
    );
    return $h2o->render(array_merge($globals,$variables));
}
