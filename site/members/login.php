<?php
require_once('../global.include.php');
/* Check login form from /login.html
   Use proper sanitation: stripslashes(mysql_real_escape_string($data));
   Make sure to hash the password before matching (If using a salt, add the salt value accordingly)
*/

if($logged_in == true) {
  echo('You are already logged in to an account, please <a href="/members/logout.php">logout</a> first.');
}
else {
  $sql = "SELECT * FROM `users` WHERE username='$username' and password='$password'";
  //$sql = "SELECT * FROM `users`";
  $con = db_connect();
  $username = db_escape($_POST['username']);
  $password = db_escape($_POST['password']);

  $query = db_query($sql);

  $count = row_count($sql);

  if($count == 1) {
    // Register username & password
    session_register("username");
    session_register("password");
    $_SESSION['loggedin'] = true; // Let us know they are logged in
    mysql_close($con); // Always close MySQL connection to prevent issues (too many sql sessions)
    header("location:index.html"); // Redirect the user
  }
  else {
    //mysql_close($con); // Always close MySQL connection to prevent issues (too many sql sessions)
    echo('Wrong username and password combination! <a href="/members/login.html">Try again</a>');
  }
}
?>