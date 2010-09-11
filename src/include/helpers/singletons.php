<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * helpers/singletons.php
 *
 * Yes, i know, singleton is evil....
 * but i dont'have time to come up with a better idea
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
 * get_session 
 * 
 * @access public
 * @return Session
 */
function get_session()
{
    static $session;
    if (!$session) {
        $session = new session_class();
    }
    return $session;
}

/**
 * get_dbh 
 * 
 * @access public
 * @return SQL_Class
 */
function get_dbh()
{
    static $dbh;
    if (!$dbh) {
        $dbh = new SQL_Class;
    }
    return $dbh;
}

/**
 * get_logged_user 
 * 
 * @access public
 * @return User
 */
function get_logged_user()
{
    static $user;
    if (!$user) {
        $session = get_session();
        $user = $session->get_logged_user();
    }
    return $user;
}
