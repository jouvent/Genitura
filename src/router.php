<?php
/* $routes is an array of arrays, each sub array must be 3 long with
 * - string $patern (any regexp patern that will be run against the query_string)
 * - string $location ( on the form <file_path>::<function_name>, both have to be valid)
 * - array  $params (any key/value pairs that will be passed to the controler function)
 */
$paterns = array(
        // static pages
        array('^$','cms::page',array('home')),
        //array('^about$','flatpages::about',array()),
        //array('^photos$','flatpages::images',array()),
        //array('^news$','flatpages::news',array()),
        // authentication
        array('^login$','auth::login_user',array()),
        array('^logout$','auth::logout_user',array()),
        // lang preferences
        array('^lang/en$','lang::en',array()),
        array('^lang/fr','lang::fr',array()),
        array('^rules/fr','flatpages::rules',array('fr')),
        array('^rules/en','flatpages::rules',array('en')),
        // invite pages
        array('^mypage$','users::my_page',array()),
        array('^user/page/(?<id>\d+)$','users::view_user',array()),
        array('^invite/(?<id>\d+)$','users::view_invite',array()),
        array('^invite/edit/(?<id>\d+)$','users::edit_invite',array()),
        // admin pages
        array('^organisateur/(?<id>\d+)$','admin::admin_page',array()),
        array('^organisateur/edit/(?<id>\d+)$','admin::edit',array()),
        // group pages
        array('^group/(?<id>\d+)$','groups::group_page',array()),
        array('^group/add$','groups::add',array()),
        array('^group/edit/(?<id>\d+)$','groups::edit',array()),
        // bus pages
        array('^bus/(?<id>\d+)$','buses::bus_page',array()),
        array('^bus/add/(?<group_id>\d+)$','buses::add',array()),
        array('^bus/edit/(?<bus_id>\d+)$','buses::edit',array()),
        array('^bus/couples/(?<bus_id>\d+)', 'buses::update_couple_order', array()),
        // emails
        array('^email/user/(?<id>\d+)$','email::email_user',array()),
        array('^email/group/(?<id>\d+)$','email::email_group',array()),
        array('^email/bus/(?<id>\d+)$','email::email_bus',array()),
        array('^email/all','email::email_all',array()),
        // user listing
        array('^user/bus/(?<id>\d+)$','users::user_by_bus',array()),
        array('^user/group/(?<id>\d+)$','users::user_by_group',array()),
        array('^user/inviter/(?<id>\d+)$','invitation::user_by_inviter',array()),
        array('^user/search$','users::search',array()),
        array('^contact/$','contact::contact',array()),
        // purchase related
        array('^purchase$','basket::basket',array()),
        array('^purchase/success', 'basket::success', array()),
        array('^purchase/fail', 'basket::fail', array()),
        array('^purchase/checkout', 'basket::checkout', array()),
        // invitation pages
        array('^invitation/invite','invitation::invite_user',array()),
        array('^invitation/csv','invitation::invitation_csv',array()),
        // ajax requests
        array('^ajax/group_bus_navigation','ajax::group_bus_navigation',array()),
        // registration
        array('^registration/$','registration::invitation_key',array()),
        array('^registration/userinfo$','registration::user_info',array()),
        array('^registration/tablee$','registration::user_tablee',array()),
        array('^registration/friends$','registration::user_friends',array()),
        array('^registration/paypal$','registration::registration_paypal',array()),
        array('^registration/paypal/success$','registration::registration_paypal_success',array()),
        array('^registration/paypal/cancelled$','registration::registration_paypal_cancelled',array()),
        array('^registration/fin$','registration::registration_fin',array()),
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
    if( strpos($url,'?') !== false){
        $url = substr($url,0, strpos($url,'?'));
    }
    foreach($routes as $route){
        //echo "dans boucle\n";
        if(is_array($options = match($url,$route[0]))){
            $route[2] = array_merge($route[2],$options);
            return $route;
        }
    }
    return false;
}

/* return false on non matching patern, matched param (only associatives ones) if match */
function match($url, $patern){
    //echo "dans match $patern $url\n";
    $options = array();
    $params = array();

    // antislash les slashes
    $patern = str_replace('/','\\/',$patern);

    if(preg_match("/$patern/",$url,$options)){
        //echo "match !!\n";
        foreach($options as $key => $value){
            //echo "teste $key => $value\n";
            if(is_string($key)){
                //echo "accepte $key => $value\n";
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
    require_once($location[0].'/controllers.php');
    if(file_exists($location[0].'/models.php')){
        require_once($location[0].'/models.php');
    }
    return call_user_func_array($location[1],$route[2]);
}
?>
