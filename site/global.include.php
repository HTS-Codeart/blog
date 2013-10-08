<?php

/* Include all other php files that will be loaded dynamically
   For example, you may have sidebar.php which contains the contents of some sidebar html code
   You can include the file here, as well as other files, so that all we need is to add this one file to static pages.
*/


/* Define constants here */
DEFINE('SITE_ROOT',$_SERVER['DOCUMENT_ROOT']);
DEFINE('INCLUDES',SITE_ROOT . '/includes');
DEFINE('HEADER',INCLUDES . '/templates/header.php');
DEFINE('FOOTER',INCLUDES . '/templates/footer.php');
DEFINE('FUNCTIONS',INCLUDES . '/functions');
DEFINE('SIDEBAR',INCLUDES . '/templates/sidebar.php');


/* Require all the required shiz here */
require_once(FUNCTIONS . '/mysql.php');
require_once(FUNCTIONS . '/auth.php');


?>
