<?php
require_once 'boot.php';
Doctrine_Core::loadModels('include/models/generated');
Doctrine_Core::loadModels('include/models');

$user = get_logged_user();
try {
    $route = route($_SERVER['REQUEST_URI'],$paterns);
    if(is_array($route)){
        echo load($route);
    } else {
        throw new NotFoundException('no route found!!');    
    }
} catch (NotFoundException $e){
    header('HTTP/1.1 404 Not Found');
    echo render('errors/not_found.tpl');
} catch( LoginRequiredException $e) {
    echo redirect('/login');
} catch ( Exception $e){
    header('HTTP/1.1 500 Internal Server Error');
    $fields['exception'] = $e;
    echo render('errors/internal.tpl',$fields);
}
?>
