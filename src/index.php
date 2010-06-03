<?php
error_reporting(E_ALL);
ini_set("display_errors", 1); 

require_once 'boot.php';
Doctrine_Core::loadModels('include/models/generated');
Doctrine_Core::loadModels('include/models');

try {
    $router = router($_SERVER['REQUEST_URI'],'urls.php');
    $route = $router->route();
    if($route) {
        echo load($route);
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
    echo render('errors/internal.tpl',$fields);
}

/* include and run given route */
function load(Route $route){
    $location = explode('::',$route->getLocation());
    require_once($location[0].'/init.php');
    return call_user_func_array($location[1],$route->getOptions());
}
?>
