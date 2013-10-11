<?php
/* Ensure proper sanitation of fields: stripslashes(mysql_real_escape_string($data));
   Connect to the database
   Check the database for existing users with the same information
   Validate real email address: filter_var($email, FILTER_VALIDATE_EMAIL)
   Push user information into the database, if no errors occur
   Echo out data to the login page to be user friendly with a restration success message
   (If you are feeling fancy, have the script email a verification code)
   Make sure to close all MySQL Connections to prevent too many sessions error
CREATE TABLE `a7057662_db`.`login` (
`id` INT NOT NULL AUTO_INCREMENT ,
`username` VARCHAR( 25 ) NOT NULL ,
`passwordhash` VARCHAR( 50 ) NOT NULL ,
`salt` VARCHAR( 32 ) NOT NULL ,
`registration_email` VARCHAR( 50 ) NOT NULL ,
`registration_date` DATETIME NOT NULL ,
`registration_ip` INT( 20 ) NOT NULL ,
`hide_email` VARCHAR( 10 ) NOT NULL ,
`group` INT( 2 ) NULL ,
`access` INT( 2 ) NULL ,
`security_question` TEXT NOT NULL ,
`security_answer` TEXT NOT NULL ,
`last_login_ip` INT( 20 ) NOT NULL ,
`verifyhash` VARCHAR( 50 ) NOT NULL ,
`signature` TEXT NOT NULL ,
`birthday` DATETIME NOT NULL ,
`timezone` VARCHAR( 30 ) NOT NULL ,
PRIMARY KEY ( `id` )
) ENGINE = MYISAM


*/

require_once('../global.include.php'); /* includes db_connect, db_query, and db_escape */

// Generating a random salt value
function unique_md5() {
    mt_srand(microtime(true)*100000 + memory_get_usage(true));
    return md5(uniqid(mt_rand(), true));
}

/* in depth form validation needs to happen here */

//$fname = db_escape($_POST['fname']); Probably will not use
//$lname = db_escape($_POST['lname']); Probably will not use
$username = db_escape($_POST['username']);
$password = db_escape($_POST['password']);
$registration_email = db_escape($_POST['email']);
$registration_ip = $_SERVER['REMOTE_ADDR'];
$registration_date = date();	//finish this
$hide_email = db_escape($_POST['hide_email']);
$group = 1; 			//or whatever default group is
$access = 0;			//or whatever default access level is
$security_question = db_escape($_POST['security_question']);
$security_answer = db_escape($_POST['security_answer']);
$signature = db_escape($_POST['signature']);
$birthday = db_escape($_POST['birthday']);
$timezone = db_escape($_POST['timezone']);
//$verifyhash = create_verifyhash();

$salt     = unique_md5(); // Store random salt in $salt
$passwordhash  = hash('sha256',($password . $salt));


/* After everything is validated and verified
	insert everything into the db */



?>
