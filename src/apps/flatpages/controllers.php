<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * flatpages/controllers.php
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Flatpages_Controller
 * @author   Julien Jouvent-Halle <julienhalle@heptacube.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://github.com/jouvent/Genitura
 * @since    0.0.2
 */

/**
 * page 
 * 
 * @param string $page the static page
 *
 * @access public
 * @return string
 */
function page($request)
{
    $page = $request->getParam('page');
    return render("$page.tpl");
}
