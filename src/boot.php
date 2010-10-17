<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * boot.php
 *
 * PHP version 5
 *
 * @category   Boot
 * @package    Core
 * @subpackage Core_Boot
 * @author     Julien Jouvent-Halle <julienhalle@heptacube.com>
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 * @link       http://github.com/jouvent/Genitura
 * @since      0.0.2
 */

/* first we play with the include path */
$pwd = realpath(dirname(__FILE__)); // here we are
$ps = PATH_SEPARATOR;

set_include_path(get_include_path()."$ps$pwd");
set_include_path(get_include_path()."$ps$pwd/apps");
set_include_path(get_include_path()."$ps$pwd/include");
set_include_path(get_include_path()."$ps$pwd/include/vendors");

/* second we include the basics */
require_once 'configs.inc.php'; // the app configurations
require_once 'router.php'; // the url mappings
require_once 'helpers/render.php';
require_once 'helpers/requests.php';
require_once 'helpers/security.php';
require_once 'helpers/errors.php';
require_once 'helpers/upload.php';
require_once 'errors/exceptions.php';

require_once 'h2o/h2o.php'; // the template engine
require_once 'template/filters.php'; // custom filters for the template engine

require_once 'doctrine/Doctrine.php'; // the ORM engine
require_once 'doctrine/doctrine_bootstrap.php';

//-- START INCLUDE --//
require_once 'include/request/request.php';
require_once 'include/response/response.php';
require_once 'session/session_class.php';
require_once 'template/select_class.php';

/* evil singleton... */
require_once 'helpers/singletons.php';

session_start();
