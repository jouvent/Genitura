<?php

/** session_class
 * @desc manage cookies, authentification and permissions.
 * @author Heptacube Inc.
 * @version November 17 2006.
 */

class session_class extends SQL_Class {
	var $logged;

	function session_class() {
		parent::SQL_Class("deb");

		// check for valid a cookie.
		$count = 0;
		if (isset($_COOKIE['Auth'])) {
			$stmt = $this->execute("SELECT COUNT(*) FROM deb_tmp_keys WHERE
					thekey = '".$_COOKIE['Auth']."'
					AND ip = '".getenv("REMOTE_ADDR")."'
                    AND expiration > '".strtotime("+2 minutes")."'
                    AND type != 'R'");
			$count = $stmt->sql_result();
		}
		if ($count == 1)
        {
            $this->logged = true;
            $s = $this->execute("SELECT user.id, user.name, user.type FROM user
								LEFT JOIN deb_tmp_keys on (deb_tmp_keys.uid = user.id)
								WHERE deb_tmp_keys.thekey = '".$_COOKIE['Auth']."'");
            list($this->user_id, $this->user_name, $this->user_type) = $s->fetch_array();

			$this->execute("UPDATE deb_tmp_keys SET expiration='".strtotime("+59 minutes")."'
					WHERE thekey = '".$_COOKIE['Auth']."'
                    AND ip = '".getenv("REMOTE_ADDR")."'");
        }
        else
        {
            $this->logged = false;
            $stmt = $this->execute("SELECT COUNT(*) FROM deb_tmp_keys WHERE
                    thekey = '".$_COOKIE['Auth']."'
                    AND ip = '".getenv("REMOTE_ADDR")."'
                    AND expiration > '".strtotime("+2 minutes")."'
                    AND type = 'R'");
            $count = $stmt->sql_result();
            $this->registering = ($count == 1);
            if($this->registering){
                $s = $this->execute("SELECT user.id, user.name, user.type FROM user
                                    LEFT JOIN deb_tmp_keys on (deb_tmp_keys.uid = user.id)
                                    WHERE deb_tmp_keys.thekey = '".$_COOKIE['Auth']."'");
                list($this->user_id, $this->user_name, $this->user_type) = $s->fetch_array();
            }
        }
		$this->execute("DELETE FROM deb_tmp_keys WHERE expiration < '".strtotime("+2 minutes")."'");
	}

	/** islogged()
	 * @desc Tell us if the cookie have been checked.
	 * @return true is cookie is good, false otherwise.
	 */

	function islogged() {
		if ($this->logged == true) {
			return true;
		}

		return false;
	}

	/** login()
	 * @desc Do a simple user and password check on the database.
	 * @param string $l, string $p.
	 * @return true is the password is good, false otherwise.
	 */
	function login($l, $p) {
		$thekey = md5(getenv("REMOTE_ADDR").date("d").rand(1,1000));
		$count = 0;

		$s = $this->execute("SELECT COUNT(*) FROM user WHERE
            login_email = '".addslashes($l)."' AND password = '".md5($p)."'
            AND is_blacklisted = 0 AND invite_status > 3");
		$count = $s->sql_result();
		if ($count == 1) {
			$s = $this->execute("SELECT id, type, name FROM user WHERE
			login_email = '".addslashes($l)."' AND password = '".md5($p)."'");
			list($id, $type, $screenName) = $s->fetch_array();


			$stmt = $this->execute("INSERT INTO deb_tmp_keys SET
					thekey = '".$thekey."',
					ip = '".getenv("REMOTE_ADDR")."',
					type = '".$type."',
					uid = '".$id."',
					expiration= '".strtotime("+59 minutes")."'");
			$this->put_cook( $thekey );
			return true;
		}
		else {
			return false;
		}

	}

    function start_registration($invte_key){
		$thekey = md5(getenv("REMOTE_ADDR").date("d").rand(1,1000));
		$count = 0;

		$s = $this->execute("SELECT COUNT(*) FROM user WHERE
            invite_key = '".addslashes($invte_key)."'
            AND invite_key != ''
            AND invite_status BETWEEN 0 AND 3");
		$count = $s->sql_result();
		if ($count == 1) {
			$s = $this->execute("SELECT id FROM user WHERE
            invite_key = '".addslashes($invte_key)."'");
			list($id) = $s->fetch_array();

            $type = 'R';

			$stmt = $this->execute("INSERT INTO deb_tmp_keys SET
					thekey = '".$thekey."',
					ip = '".getenv("REMOTE_ADDR")."',
					type = '".$type."',
					uid = '".$id."',
					expiration= '".strtotime("+59 minutes")."'");
			$this->put_cook( $thekey );
            $this->user_id = $id;
			return true;
		}
		else {
			return false;
		}
    }

	function isRegistering() {
		if ($this->registering == true) {
			$this->execute("UPDATE deb_tmp_keys SET expiration='".strtotime("+59 minutes")."'
					WHERE thekey = '".$_COOKIE['Auth']."'
                    AND ip = '".getenv("REMOTE_ADDR")."'");
			return true;
		}

		return false;
	}


	/** put_cook()
	 * @desc set the cookie to the user
	 */

	function put_cook( $thekey ) {
		setcookie('Auth', $thekey , time()+60*60*24*30);
	}

	function whoAMI() {
		$s = $this->execute("SELECT user.id, user.name, user.type FROM user
								LEFT JOIN deb_tmp_keys on (deb_tmp_keys.uid = user.id)
								WHERE deb_tmp_keys.thekey = '".$_COOKIE['Auth']."'");
		list($uid, $name, $type) = $s->fetch_array();
		return array(0=>$uid, 1=>$name, 2=>$type);

	} //whoAMI

	function logout() {
		$s = $this->execute("DELETE FROM deb_tmp_keys WHERE thekey = '".$_COOKIE['Auth']."'");
	}
}
?>
