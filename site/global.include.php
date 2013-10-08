<?php

/* Include all other php files that will be loaded dynamically
   For example, you may have sidebar.php which contains the contents of some sidebar html code
   You can include the file here, as well as other files, so that all we need is to add this one file to static pages.
*/

include './includes/templates/header.php';
include './includes/templates/footer.php';
include './includes/templates/sidebar.php';
include './includes/templates/navbar.php';
// Shitty but works for now
?>
