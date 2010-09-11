<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * faq/urls.php
 *
 * PHP version 5
 *
 * @category Urls
 * @package  CMS_Urls
 * @author   Julien Jouvent-Halle <julienhalle@heptacube.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://github.com/jouvent/Genitura
 * @since    0.0.2
 */

$faq_routes = array(
        route('^$', 'cms::faq', array()),
        route('^add$', 'cms::faq_add', array()),
        route('^list$', 'cms::faq_list', array()),
        route('^edit/(?<id>\d+)$', 'cms::faq_edit', array()),
    );
