<?php

/* Include all other php files that will be loaded dynamically
   For example, you may have sidebar.php which contains the contents of some sidebar html code
   You can include the file here, as well as other files, so that all we need is to add this one file to static pages.
*/

DEFINE('SITE_ROOT',getcwd());
DEFINE('INCLUDES',SITE_ROOT . '/includes');
DEFINE('HEADER',INCLUDES . '/templates/header.php');
DEFINE('FOOTER',INCLUDES . '/templates/footer.php');
DEFINE('SIDEBAR',INCLUDES . '/templates/sidebar.php');
DEFINE('NAVBAR',INCLUDES . '/templates/navbar.php');
DEFINE('FUNCTIONS',INCLUDES . '/functions');



/* Require all the required shiz here */
require_once(FUNCTIONS . '/mysql.php');
require_once(FUNCTIONS . '/auth.php');
?>

