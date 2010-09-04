<?php
require_once 'cms/faq.php';
require_once 'cms/pages.php';

function actions()
{
    i_am_logged();
    return render('settings.tpl',array());
}

