<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * router.php
 *
 * contain classes needed to find the controller corresponding to given URI
 *
 * PHP version 5
 *
 * @category   Session
 * @package    Core
 * @subpackage Core_Session
 * @author     Julien Jouvent-Halle <julienhalle@heptacube.com>
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 * @link       http://github.com/jouvent/Genitura
 * @since      0.0.2
 */

/**
 * session_class
 *
 * manage user authentification
 *
 * @category   Routing
 * @package    Core
 * @subpackage Core_Route
 * @author     Julien Jouvent-Halle <julienhalle@heptacube.com>
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 * @link       http://github.com/jouvent/Genitura
 * @since      0.0.2
 */
class session_class
{

    private $_logged;
    private $_session;

    /**
     * session_class 
     * 
     * @access public
     * @return void
     */
    function session_class()
    {

        // check for valid a cookie.
        if (isset($_COOKIE['auth'])) {
            $auth = $_COOKIE['auth'];
            $ip = getenv('REMOTE_ADDR');
            $time = strtotime('+2');
            $this->_session = Session::getSession($auth, $ip, $time);
        }
        if ( $this->_session && $this->_session->exists() ) {
            $this->_session->expiration = strtotime('+59 minutes');
            $this->_logged = true;
        }
    }

    /**
     * islogged 
     *
     * Tell us if the cookie have been checked.
     * 
     * @access public
     * @return void
     */
    function islogged()
    {
        return $this->_logged ;
    }

    /**
     * login 
     * 
     * @param string $l the user login
     * @param string $p the user password
     *
     * @access public
     * @return void
     */
    function login($l, $p)
    {
        $user = User::getByCredential($l, $p);
        if ($user && $user->exists()) {
            $session = new Session();
            $ip = getenv('REMOTE_ADDR');
            $date = date('d');
            $seed = rand(1, 1000);
            $session->session_key = md5($ip.$date.$seed);
            $session->ip = getenv("REMOTE_ADDR");
            $session->expiration = strtotime("+59 minutes");
            $session->User = $user;
            $session->save();
            $this->_session = $session;

            $this->put_cook($session->session_key);
            $this->_logged = true;
            return true;
        }
        return false;
    }

    /**
     * put_cook 
     * 
     * @param mixed $thekey what to put in the cookie
     *
     * @access public
     * @return void
     */
    function put_cook( $thekey )
    {
        setcookie('auth', $thekey, strtotime('+30 days'));
    }

    /**
     * logout 
     * 
     * @access public
     * @return void
     */
    function logout()
    {
        setcookie('auth', '', strtotime('-1 minutes'));
        if ($this->_session) {
            return $this->_session->delete();
        }
    }

    /**
     * get_logged_user 
     * 
     * @access public
     * @return User
     */
    function get_logged_user()
    {
        if ($this->_session) {
            return $this->_session->User;
        }
    }
}
?>
