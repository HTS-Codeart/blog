<?php

echo '<div id="menubar"> <ul id="menu">';

if($logged_in == true) {
  $links = array(
  "Home" => "/index.html",
  "My Account" => "/#",
  "Settings" => "/#",
  "About Us" => "/info.html",
  "Logout" => "/logout.php",
 );
} else {
  $links = array(
  "Home" => "/index.html",
  "Register" => "/registration.html",
  "About Us" => "/info.html",
  );
}

foreach($links as $title => $url) {
  echo "<li><a href=\"$url\">$title</a></li>";
}
echo "</ul></div>";

?>