<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * auth/controllers.php
 *
 * PHP version 5
 *
 * @category Controllee
 * @package  Auth_Controller
 * @author   Julien Jouvent-Halle <julienhalle@heptacube.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://github.com/jouvent/Genitura
 * @since    0.0.2
 */

/**
 * login_user 
 * 
 * @access public
 * @return string
 */
function login_user()
{
    $data = new array();
    if (is_post()) {
        $session =  get_session();

        if ($session->login($_POST['USERNAME'], $_POST['PASSWORD'])) {
            return redirect('/');
        }
        $data['error'] = "Invalid email and/or password. Please check your entry.";
    }
    return render('login.tpl', $data);
}

/**
 * logout_user 
 * 
 * @access public
 * @return string
 */
function logout_user()
{
    $session =  get_session();
    $session->logout();
    return redirect('/');
}
