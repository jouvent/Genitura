<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * lang/controllers.php
 *
 * contain controllers function for the lang app
 *
 * set a cookie for the language
 *
 * PHP version 5
 *
 * @category   Controller
 * @package    Lang
 * @subpackage Lang_Controller
 * @author     Julien Jouvent-Halle <julienhalle@heptacube.com>
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 * @link       http://github.com/jouvent/Genitura
 * @since      0.0.2
 */

/**
 * Set the passed lang in a cookie and redirect away
 *
 * @param string $lang the language code to be setted
 *
 * @return string null
 */
function set_lang($lang)
{
    setcookie('lang', $lang, time()+60*60*24*30, '/');

    return redirect($_SERVER['HTTP_REFERER']);
}
