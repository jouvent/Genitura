<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * index.php
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
error_reporting(E_ALL);
ini_set("display_errors", 1); 

try {
    require_once 'boot.php';
    Doctrine_Core::loadModels('include/models/generated');
    Doctrine_Core::loadModels('include/models');

    $request = requestFromEnv();
    $router = router($_SERVER['REQUEST_URI'], 'urls.php');
    $route = $router->route();
    if ($route) {
        echo load($route, $request);
    } else {
        throw new NotFoundException('no route found!!');    
    }
} catch (NotFoundException $e) {
    header('HTTP/1.1 404 Not Found');
    echo render('errors/not_found.tpl');
} catch( LoginRequiredException $e) {
    echo redirect('/login');
} catch ( Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    $fields['exception'] = $e;
    echo render('errors/internal.tpl', $fields);
}

/**
 * include and run given route 
 *
 * @param Route $route the route to be loaded
 *
 * @return string the produced HTML to render
 *
 * @access public
 */
function load(Route $route, Request $request)
{
    $location = explode('::', $route->getLocation());
    include_once $location[0].'/init.php';
    $request->addParams($route->getOptions());
    return call_user_func($location[1], $request);
}
?>
