<?php
/* $routes is an array of arrays, each sub array must be 3 long with
 * - string $patern (any regexp patern that will be run against the query_string)
 * - string $location ( on the form <file_path>::<function_name>, both have to be valid)
 * - array  $params (any key/value pairs that will be passed to the controler function)
 */
$paterns = array(
        // static pages
        array('^$','flatpages::page',array('home')),
        // authentication
        array('^login$','auth::login_user',array()),
        array('^logout$','auth::logout_user',array()),
        // lang preferences
        array('^lang/en$','lang::en',array()),
        array('^lang/fr','lang::fr',array()),
        // settings stuff
        array('^settings$','cms::actions',array()),
        // faq
        array('^faq$','cms::faq',array()),
        array('^faq/add$','cms::faq_add',array()),
        array('^faq/list$','cms::faq_list',array()),
        array('^faq/edit/(?<id>\d+)$','cms::faq_edit',array()),
        // pages
        array('^page/add$','cms::page_add',array()),
        array('^page/list$','cms::page_list',array()),
        array('^page/edit/(?<slug>\w+)$','cms::page_edit',array()),
        array('^(?<slug>\w+)$','cms::page',array()),
    );


/* return the first matching routes with matching additionnal param if any, return false if no match */
function route($url, array $routes){
    // enlever le premier / qui est innutile
    $url = substr($url,1);
    // enlever les parametres GET
    foreach($routes as $route){
        if(is_array($options = match($url,$route[0]))){
            $route[2] = array_merge($route[2],$options);
            return $route;
        }
    }
    return false;
}

/* return false on non matching patern, matched param (only associatives ones) if match */
function match($url, $patern){
    $options = array();
    $params = array();

    // antislash les slashes
    $patern = str_replace('/','\\/',$patern);

    if(preg_match("/$patern/",$url,$options)){
        foreach($options as $key => $value){
            if(is_string($key)){
                $params[$key] = $value;
            }
        }
        return $params;
    }
    return false;
}

/* include and run given route */
function load(array $route){
    $location = explode('::',$route[1]);
    require_once($location[0].'/init.php');
    return call_user_func_array($location[1],$route[2]);
}
?>
