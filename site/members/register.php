<?php

	/* The big thing here is the validation. Right now, the validation is coded in PHP and echo's out all of the errors at the end.
		This can really be done a number of ways. You could go down the list and echo back out the first error it comes across
		and echo that out. Or we could code the entire validation process through JavaScript and have PHP assume that the form
		is all good to go. IT's really up to you guys. I just did it this way for right now.*/

		/*Side note: Things like the security answer and question currently have requirements on them. I myself like the idea of
			taking the security question from a list and checking that way. Then leave a minimum char req on the answer. --will update*/

	if(empty($_POST)) {				//to check if the user submitted a registration. Can also use $_SERVER variables to check like HTTP_REFERER
		require_once('register.html');
	} else {

	require_once('../global.include.php'); /* includes db_connect, db_query, and db_escape */

		/* in depth form validation needs to happen here */

		$errormsg = "";
		if((trim($_POST['username']) != "") && (strlen(trim($_POST['username'])) >= 1) && (strlen(trim($_POST['username'])) <= 20) &&
			(preg_match("/[^-a-z0-9_]/i", trim($_POST['username'])) != 1)) {
				$username = db_escape(trim($_POST['username']));
		} else {
			$errormsg .= "-username must only contain a-Z0-9-_ characters and be less than 20 characters<br>";
		}
		if(strlen($_POST['password']) >= 6) {				//may also need to add in regex
			$password = db_escape($_POST['password']);
			$salt = unique_md5(); // Store random salt in $salt
			$passwordhash  = hash('sha256',($password . $salt));
		} else {
			$errormsg .= "-password must be more than six characters<br>";
		}
		if($_POST['confirm'] != $_POST['password']) {
			$errormsg .= "-passwords did not match<br>";
		}
		if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) == true) {
			$registration_email = db_escape($_POST['email']);
		} else {
			$errormsg .= "-email must be a valid email<br>";
		}
		$registration_ip = ip2long($_SERVER['REMOTE_ADDR']);
		$registration_date = date("M d, Y");
		if((isset($_POST['hide_email'])) && is_numeric($_POST['hide_email']) && (($_POST['hide_email'] == 1) || $_POST['hide_email'] == 0)) {
			$hide_email = db_escape($_POST['hide_email']);
		} else {
			$errormsg .= "-hide email must be yes/no<br>";
		}
		$group = 1; 			//or whatever default group is
		//$access = 0;			//or whatever default access level is
		if((strlen(trim($_POST['security_question'])) >= 10) && strlen(trim($_POST['security_question'])) <= 200) {
			$security_question = db_escape(trim($_POST['security_question']));
		} else {
			$errormsg .= "-security question must be within 10 and 200 characters<br>";
		}
		if((strlen(trim($_POST['security_answer'])) >= 4) && (strlen(trim($_POST['security_answer'])) <= 100)) {
			$security_answer = db_escape(trim($_POST['security_answer']));
		} else {
			$errormsg .+ "-security answer must be within 4 and 100 characters<br>";
		}
		if($_POST['signature'] != "") {
			$signature = db_escape($_POST['signature']);
		} else {
			$signature = "NULL";					//Since it's getting pushed into the DB either way
		}
		/* To get the birthday we concatenate the three forms: month, day, year */
		if(($_POST['month'] != "") && ($_POST['day'] != "") && ($_POST['year'] != "") && (checkdate($_POST['month'], $_POST['day'], $_POST['year']))) {
			$birthday = db_escape($_POST['month'] . ' ' . $_POST['day'] . ' ' . $_POST['year']);
		} else {
			$errormsg .= "-birthday must be a correct date<br>";
		}
		$possible_timezones = array('-12','-11','-10','-9','-8','-7','-6','-5','-4','-3.5','-3','-2','-1','0','1','2','3','3.5','4','4.5','5','5.5','5.75','6','7','8','9','9.5','10','11','12');
		if(in_array($_POST['timezone'],$possible_timezones)) {
			$timezone = $_POST['timezone'];
		} else {
			$errormsg .= "-timezone must be an accurate timezone<br>";
		}
		$verifyhash = unique_md5();;

		if($errormsg != "") {
			require_once('register.html');
		} else {
			/* Send that shiz to the db*/
			$sql = "INSERT INTO `users` (username,passwordhash,salt,registration_email,registration_date,registration_ip,hide_email,security_question," .
				"security_answer,verifyhash,signature,birthday,timezone)" .
				" VALUES ('$username','$passwordhash','$salt','$registration_email','$registration_date','$registration_ip','$hide_email'," .
				"'$security_question','$security_answer','$verifyhash','$signature','$birthday','$timezone')";
			if(db_query($sql)) {
				/* Refer to post-registration page */
				echo("<br>Welcome to HTSCodeart $username. The site is still under development.<br>");			//temp
			} /*else {
				do_error_report();					//no error reporting at the moment. Should probably implement
			} */
		}
	}

// Generating a random md5 value
function unique_md5() {
	mt_srand(microtime(true)*100000 + memory_get_usage(true));
	return md5(uniqid(mt_rand(), true));
}
