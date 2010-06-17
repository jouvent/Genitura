<?php
$pwd = dirname(__FILE__);
set_include_path(dirname(__FILE__).PATH_SEPARATOR.get_include_path());

include 'controllers.php';

/*
 *
 * This apps depends on : 
 */
require_once 'users/init.php';
