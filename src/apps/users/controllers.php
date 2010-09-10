<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * user/controllers.php
 *
 * php version 5
 *
 * @category Controller
 * @package  User_Controller
 * @author   julien jouvent-halle <julienhalle@heptacube.com>
 * @license  http://www.opensource.org/licenses/mit-license.php mit license
 * @link     http://github.com/jouvent/genitura
 * @since    0.0.2
 */


/**
 * view_user 
 * 
 * @param mixed $id the unique identifier
 *
 * @access public
 * @return string
 */
function view_user($id)
{
    $user = User::fetch($id);
    if (!$user) {
        throw new NotFoundException();
    }
    return render('user_view.tpl', compact('user'));
}

/**
 * my_page 
 * 
 * @access public
 * @return string
 */
function my_page()
{
    $session = get_session();
    if (!$session->logged) {
        return redirect('/');
    }
    $me = $session->whoAMI();
    return view_user($me[0]);
}

/**
 * edit_user 
 * 
 * @param mixed $id the unique identifier
 *
 * @access public
 * @return string
 */
function edit_user($id)
{
    i_am_logged();
    $user = fetch_or_404('User', $id);

    if (is_post()) {
        $user->fromArray($_POST);
        if ($user->isValid()) {
            $user->save();
            return redirect('/user/page/'.$user->id);
        } else {
            $errors = array();
            $errors['user'] = get_errors($user);
        }
    }

    return render('user_edit.tpl', compact('user', 'errors'));
}
