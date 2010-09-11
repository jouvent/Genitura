<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * helpers/security.php
 *
 * PHP version 5
 *
 * @category   Helpers
 * @package    Core
 * @subpackage Core_Helpers
 * @author     Julien Jouvent-Halle <julienhalle@heptacube.com>
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 * @link       http://github.com/jouvent/Genitura
 * @since      0.0.2
 */

/**
 * fetch_or_404 
 * 
 * @param mixed $class a Doctrine Model class
 * @param mixed $id    a unique identifier 
 *
 * @access public
 * @return mixed
 */
function fetch_or_404($class, $id)
{
    $obj = call_user_func(array($class, 'fetch'), $id);
    if (!$obj) {
        throw new NotFoundException(); 
    }
    return $obj;
}

/**
 * i_am_logged 
 * 
 * @access public
 * @return boolean
 */
function i_am_logged()
{
    $session = get_session();
    if (!$session->islogged()) {
        throw new LoginRequiredException(); 
    }
    return true;
}
