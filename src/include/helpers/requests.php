<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * helpers/request.php
 *
 * PHP version 5
 *
 * @category   Request
 * @package    Core
 * @subpackage Core_Request
 * @author     Julien Jouvent-Halle <julienhalle@heptacube.com>
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 * @link       http://github.com/jouvent/Genitura
 * @since      0.0.2
 */

/**
 * is_post 
 * 
 * @access public
 * @return boolean
 */
function is_post()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

/**
 * redirect 
 * 
 * @param string $location where to go
 *
 * @access public
 * @return void
 */
function redirect($location)
{
    if ($location) {
        return header("Location: $location");
    } else {
        return header("Location: /");
    }
}
