/* Ensure proper sanitation of fields: stripslashes(mysql_real_escape_string($data));
   Connect to the database
   Check the database for existing users with the same information
   Validate real email address: filter_var($email, FILTER_VALIDATE_EMAIL)
   Push user information into the database, if no errors occur
   Echo out data to the login page to be user friendly with a restration success message
   (If you are feeling fancy, have the script email a verification code)
*/
