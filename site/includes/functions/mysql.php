<?php

	/* Here we'll have all of the DB access functions and shit */
	function db_connect() {
		require_once('mysqlinfo.php');
		$dbinfo = get_mysqlinfo();
		return mysqli_connect($dbinfo['host'],$dbinfo['user'],$dbinfo['pass'],$dbinfo['db']);
	}

	function db_query($sql) {
		$con = db_connect();
		$result = mysqli_query($con,$sql);
		if(!result) {
			/* Error logging can go here */
		} else {
			return $result;
		}
	}

	function db_escape($string) {
		$con = db_connect();

		return mysqli_real_escape_string($con,$string);
	}



?>
