<?php
/* $routes is an array of arrays, each sub array must be 3 long with
 * - string $patern (any regexp patern that will be run against the query_string)
 * - string $location ( on the form <file_path>::<function_name>, both have to be valid)
 * - array  $params (any key/value pairs that will be passed to the controler function)
 */
$urls = array(
        // static pages
        route('^$','flatpages::page',array('home')),
        // authentication
        route('^login$','auth::login_user',array()),
        route('^logout$','auth::logout_user',array()),
        // lang preferences
        route('^lang',routes('apps/lang/urls.php')),
        // settings stuff
        route('^settings$','cms::actions',array()),
        // faq
        route('^faq[/]?',routes('apps/cms/urls.php','faq_routes')),
        // pages
        route('^page/add$','cms::page_add',array()),
        route('^page/list$','cms::page_list',array()),
        route('^page/edit/(?<slug>\w+)$','cms::page_edit',array()),
        route('^(?<slug>\w+)$','cms::page',array()),
    );
