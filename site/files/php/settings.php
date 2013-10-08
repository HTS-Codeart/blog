/* Ensure proper sanitation on fields: stripslashes(mysql_real_escape_string($data));
   Verify random token to prevent XSRF attacks
   Validate the password
   Change the users information in the database if no errors occur
*/
