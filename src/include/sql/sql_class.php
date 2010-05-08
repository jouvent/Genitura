<?php

class SQL_Class
{

var $host;
var $user;
var $passwd;
var $db_name;
var $dbh;
var $db;

	function SQL_Class($db='deb')
	{
		$this->host = SQL_HOST;

		switch($db)
		{
			case 'deb':
				$this->user =SQL_USER;
				$this->passwd = SQL_PASS;
				$this->db_name = SQL_DB;
				break;
		}

		if (!$this->dbh = mysql_connect($this->host, $this->user, $this->passwd))
			die("Our database is down for maintenance.<br />");
		if (!mysql_select_db($this->db_name, $this->dbh))
			die("Can't select database on host<br />");
	}



	function execute($query) {
	if (!$this->dbh)
		die("Can't execute query without connection<br>");

	$ret = mysql_query($query, $this->dbh);

	if (!$ret) {
		die("Can't send query to db<br>".$query);//Mike: i added the $query so we can know which query went wrong
		}
	else if (!is_resource($ret)) {
		return TRUE;
		}
	else {
		$stmt = new SQL_Statement($this->dbh, $query);
		$stmt->result = $ret;
		return $stmt;
		}
	}

    function last_insert_id(){
        return mysql_insert_id($this->dbh);
    }
}
?>
