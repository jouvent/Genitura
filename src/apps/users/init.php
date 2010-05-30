<?php
$pwd = dirname(__FILE__);
set_include_path(dirname(__FILE__).PATH_SEPARATOR.get_include_path());

include 'controllers.php';

if(is_dir("$pwd/models")) {
    Doctrine_Core::loadModels($pwd.'/models/generated');
    Doctrine_Core::loadModels($pwd.'/models');
}


