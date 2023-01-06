<nav class="header">

<?php 
if(logged_in()) {

  echo "<a href='{$user_page}'><img class='logo' src='media/logo.png' alt='Edmonton Sound Map'/></a>";
  
  echo "Hello, {$username}!";

  echo "<a href='{$logout_page}'>Logout</a>";

} else {

  echo "<a href='{$public_page}'><img class='logo' src='media/logo.png' alt='Edmonton Sound Map'/></a>";
  
  echo "<a href='{$register_page}'>Register</a>";

  echo "<a href='{$login_page}'>Login</a>";

}

?>
<button class="debug">click here</button>
</nav>  