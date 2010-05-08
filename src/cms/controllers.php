<?php
require_once 'cms/faq.php';
require_once 'cms/pages.php';

function actions()
{
    i_am_logged();
    $user = get_logged_user();
    if(!$user->isAdmin()){
        throw new AccessDeniedException();
    }
    return render('settings.tpl',array());
}

