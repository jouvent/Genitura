<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * user/controllers.php
 *
 * php version 5
 *
 * @category Init
 * @package  User_Init
 * @author   julien jouvent-halle <julienhalle@heptacube.com>
 * @license  http://www.opensource.org/licenses/mit-license.php mit license
 * @link     http://github.com/jouvent/genitura
 * @since    0.0.2
 */

$pwd = dirname(__FILE__);
set_include_path(dirname(__FILE__).PATH_SEPARATOR.get_include_path());

require 'controllers.php';

if (is_dir("$pwd/models")) {
    Doctrine_Core::loadModels($pwd.'/models/generated');
    Doctrine_Core::loadModels($pwd.'/models');
}
