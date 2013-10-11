<?php
function user_info() {
	require_once(mysql.php); /* includes db_connect, db_query, and db_escape */

	session_start(); // This seems like a bad way to do this, but I know no alternatives for now
	$username = $_SESSION['username']; // Grab the user's username session

	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) $logged_in = true; // Checking if they are logged in
	else $logged_in = false;

	db_connect(); // Connect to the database
	$query = db_query("SELECT * FROM `users` where username ='$username'");

	// Define some global variables, that we can use later on
	global $user, $user_email, $user_ip, $user_sec_question, $user_sec_answer, $user_signature, $user_birthday, $user_timezone;

	$row = mysql_fetch_row($query); // Grab all data from the query

	// Initialize the global varibles
	$GLOBALS['uid']					= $row[0];
	$GLOBALS['user']				= $row[1];
	$GLOBALS['user_email']			= $row[4];
	$GLOBALS['user_sec_question']	= $row[11];
	$GLOBALS['user_sec_answer']		= $row[12];
	$GLOBALS['user_ip']				= $row[13];
	$GLOBALS['user_signature']		= $row[15];
	$GLOBALS['user_birthday']		= $row[16];
	$GLOBALS['user_timezone']		= $row[17];

	mysql_close(db_connect()); // Always close MySQL connection to prevent issues (too many sql sessions)
}
?>