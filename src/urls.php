<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * urls.php
 *
 * PHP version 5
 *
 * @category   Router
 * @package    Core
 * @subpackage Core_Router
 * @author     Julien Jouvent-Halle <julienhalle@heptacube.com>
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 * @link       http://github.com/jouvent/Genitura
 * @since      0.0.2
 */

/**
 *  $urls is an array of Route object
 * - patern (any regexp patern that will be run against the query_string)
 * - location ( on the form <file_path>::<function_name>, both have to be valid)
 * - params (any key/value pairs that will be passed to the controler function)
 */
$urls = array(
    // static pages
    route('^$', 'flatpages::page', array('page'=>'home')),
    route('^about$', 'flatpages::page', array('page'=>'about')),
    // authentication
    route('^login$', 'auth::login_user', array()),
    route('^logout$', 'auth::logout_user', array()),
    // lang preferences
    route('^lang', routes('apps/lang/urls.php')),
    // settings stuff
    route('^settings$', 'cms::actions', array()),
    // faq
    route('^faq[/]?', routes('apps/cms/urls.php', 'faq_routes')),
    // pages
    route('^page/add$', 'cms::page_add', array()),
    route('^page/list$', 'cms::page_list', array()),
    route('^page/edit/(?<slug>\w+)$', 'cms::page_edit', array()),
    route('^(?<slug>\w+)$', 'cms::page', array()),
);
