<?php
$sidebar = '
<div id="site_content">
<div class="sidebar_container">

<!-- Have this done via php to switch login/Register with quick post? My account?-->
<div class="sidebar">
  <div class="sidebar_item">
    <h2>Login or <a href="/members/register.html">Register</a></h2>
    <form name="login" method="post" action="/members/login.php">
      <input name="username" type="text" id="username" value="Email">
      <input name="password" type="password" id="password" value="password">
      <input type="submit" name="Submit" value="Login"> <a href="/members/reset.html">Lost password?</a>
    </form>
  </div>
</div>

<div class="sidebar">
  <div class="sidebar_item">
    <h2>Saying Hello</h2>
    <p>Hello, world - Codeart</p>
  </div>
</div>
		<div class="sidebar">
          <div class="sidebar_item">
            <h2>In progress</h2>
            <h3>Searching</h3>
            <p>Registration Feature</p>
			<div class="readmore_small">
		      <a href="#">Comment</a>
		    </div><!--close readmore_small-->
		  </div><!--close sidebar_item-->
        </div><!--close sidebar-->
		<div class="sidebar">
          <div class="sidebar_item">
            <h3>Posting</h3>
            <p>Login Feature</p>
			<div class="readmore_small">
		      <a href="#">Read more</a>
		    </div><!--close readmore_small-->
		  </div><!--close sidebar_item-->
        </div><!--close sidebar-->
		<div class="sidebar">
          <div class="sidebar_item">
            <h3>Avatar upload</h3>
            <p>Add a feature to upload avatars during registration and via account management settings.</p>
			<div class="readmore_small">
		      <a href="#">Read more</a>
		    </div><!--close readmore_small-->
		  </div><!--close sidebar_item-->
        </div><!--close sidebar-->
        <div class="sidebar">
          <div class="sidebar_item">
            <h2>Contact me</h2>
            <p><a href="/info.html">Link</a></p>
          </div><!--close sidebar_item-->
        </div><!--close sidebar-->
       </div><!--close sidebar_container-->';

echo $sidebar;
?>
