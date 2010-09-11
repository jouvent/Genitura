<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * faq/urls.php
 *
 * PHP version 5
 *
 * @category Urls
 * @package  Lang_Urls
 * @author   Julien Jouvent-Halle <julienhalle@heptacube.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://github.com/jouvent/Genitura
 * @since    0.0.2
 */

$urls = array(
    route('^(?<lang>\w+)$', 'lang::set_lang', array()),
);
