<?php

/** session_class
 * @desc manage cookies, authentification and permissions.
 * @author Heptacube Inc.
 * @version May 9 2010.
 */

class session_class {
	private $logged;
	private $session;

	function session_class() {

        $session = null;
		// check for valid a cookie.
		if (isset($_COOKIE['auth'])) {
            $this->session = Session::getSession($_COOKIE['auth'],getenv('REMOTE_ADDR'),strtotime('+2'));
		}
        if( $this->session && $this->session->exists() ) {
            $this->session->expiration = strtotime('+59 minutes');
            $this->logged = true;
        }
	}

	/** islogged()
	 * @desc Tell us if the cookie have been checked.
	 * @return true is cookie is good, false otherwise.
	 */
	function islogged() {
		return $this->logged ;
	}

	/** login()
	 * @desc Do a simple user and password check on the database.
	 * @param string $l, string $p.
	 * @return true is the password is good, false otherwise.
	 */
	function login($l, $p) {
        $user = User::getByCredential($l,$p);
        if($user && $user->exists()) {
            $session = new Session();
            $session->session_key = md5(getenv("REMOTE_ADDR").date("d").rand(1,1000));
            $session->ip = getenv("REMOTE_ADDR");
            $session->expiration = strtotime("+59 minutes");
            $session->User = $user;
            $session->save();
            $this->session = $session;

            $this->put_cook($session->session_key);
            $this->logged = true;
			return true;
        }
        return false;
	}

	/** put_cook()
	 * @desc set the cookie to the user
	 */

	function put_cook( $thekey ) {
		setcookie('auth', $thekey , strtotime('+30 days'));
	}

	function logout() {
		setcookie('auth', '' , strtotime('-1 minutes'));
        if($this->session)
            return $this->session->delete();
	}

    function get_logged_user() {
        if($this->session) {
            return $this->session->User;
        }
    }
}
?>
