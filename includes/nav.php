<nav class="header">

<?php 

if(logged_in()) {

  echo "<a href='{$user_page}'>@yegsoundmap</a>";

  echo "Hello, {$username}!";

  echo "<a href='{$logout_page}'>Logout</a>";


} else {

  echo "<a href='{$public_page}}'>@yegsoundmap</a>";

  echo "<a href='{$register_page}'>Register</a>";

  echo "<a href='{$login_page}'>Login</a>";

}

?>
  <img src="media/logo.png" alt="logo" class="logo" />
</nav>

      