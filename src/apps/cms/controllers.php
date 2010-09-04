<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * cms/controllers.php
 *
 * PHP version 5
 *
 * @category Controller
 * @package  CMS_Controller
 * @author   Julien Jouvent-Halle <julienhalle@heptacube.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://github.com/jouvent/Genitura
 * @since    0.0.2
 */
require_once 'cms/faq.php';
require_once 'cms/pages.php';

/**
 * actions 
 * 
 * @access public
 * @return string
 */
function actions()
{
    i_am_logged();
    return render('settings.tpl', array());
}

