/* Ensure proper sanitation of fields: stripslashes(mysql_real_escape_string($data));
   Connect to the database
   Check the database for existing users with the same information
   Validate real email address: filter_var($email, FILTER_VALIDATE_EMAIL)
   Push user information into the database, if no errors occur
   Echo out data to the login page to be user friendly with a restration success message
   (If you are feeling fancy, have the script email a verification code)
   Make sure to close all MySQL Connections to prevent too many sessions error
*/

<?php

/* Set Database Information */
$db_host = "";
$db_name = "";
$db_user = "";
$db_pass = "";
// Connect to server and select databse.
mysql_connect("$db_host", "$db_user", "$db_pass")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

// Generating a random salt value
function unique_md5() {
    mt_srand(microtime(true)*100000 + memory_get_usage(true));
    return md5(uniqid(mt_rand(), true));
}

$email    = stripslashes(mysql_real_escape_string($_POST['email']));
$password = md5(stripslashes(mysql_real_escape_string($_POST['password'])));
$fname    = stripslashes(mysql_real_escape_string($_POST['firstname']));
$lname    = stripslashes(mysql_real_escape_string($_POST['lastname']));
$nick     = stripslashes(mysql_real_escape_string($_POST['nickname']));
$gender   = stripslashes(mysql_real_escape_string($_POST['gender']));
$error    = false;

$salt     = unique_md5(); // Store random salt in $salt
$newpass  = md5("$password"."$salt");

$sql_check    = "SELECT * FROM login where email='$email'";
$result_check = mysql_query($sql_check);
$count = mysql_num_rows($result_check);

// If result matched $username and $password, table row must be 1 row

if($count > 0) $error = true;
if(is_null($email) || $email == '') $error = true;
if(is_null($password) || $password == '') $error = true;
if(is_null($fname) || $fname == '') $error = true;
if(is_null($lname) || $lname == '') $error = true;
if(is_null($nick) || $nick == '') $error = true;
if(is_null($gender) || $gender == '') $error = true;

if (filter_var($email, FILTER_VALIDATE_EMAIL) && $error == false) {
    $sql      = "INSERT INTO login (email, password, salt, fname, lname, nick, gender) VALUES ('$email', '$newpass', '$salt', '$fname', '$lname', '$nick', '$gender')";
    $result   = mysql_query($sql);
    mysql_close(mysql_connect("$db_host", "$db_user", "$db_pass"));
}
  if($result) {
    echo("<html>Thank you for registering an account with us.</br>You may <a href=\"login.html\">login</a> with your email: $email and password now!</b>");
  }
  else { 
    $error = true;
  }
if($error == true) {
  echo("<html><b>There was an error registering your account!</br>Please <a href=\"register.html\">go back and try again</a>!</html>");
  mysql_close(mysql_connect("$db_host", "$db_user", "$db_pass"));
}
?>
