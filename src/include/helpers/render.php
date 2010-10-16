<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * helpers/render.php
 *
 * PHP version 5
 *
 * @category   Response
 * @package    Core
 * @subpackage Core_Response
 * @author     Julien Jouvent-Halle <julienhalle@heptacube.com>
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 * @link       http://github.com/jouvent/Genitura
 * @since      0.0.2
 */

/**
 * render 
 * 
 * @param string $template_name the template file to render
 * @param array  $variables     the data to pass to the template engine
 *
 * @access public
 * @return string
 */
function render($template_name, $variables = array())
{
    if (!isset($_COOKIE['lang'])) {
        $lang = 'fr';
    } else {
        $lang = $_COOKIE['lang'];
    }
    $h2o = new h2o(
        "$template_name",
        array(
            'searchpath' => 'templates',
            'php-i18n' => array(
                'locale' => $lang,
                'charset' => 'UTF-8',
                'gettext_path' => '/usr/bin/',
                //'extract_message' => true,
                //'compile_message' => true,
                'tmp_dir' => '/tmp/',
            )
        )
    );
    //$session = get_session();
    //$logged = $session->get_logged_user();
    $globals = array(
        'lang' => $lang, 
        'IMG_URL' => IMG_URL,
        //'islogged' => $session->isLogged(),
        //'logged' => $logged,
    );
    return $h2o->render(array_merge($globals, $variables));
}
