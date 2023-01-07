<nav class="header">

<?php 
if(logged_in()) {

  echo "<div class='nav_item'>Hello, <a class='username' href='#'>{$username}!</a></div>";
  
  echo "<a class='nav_item' href='{$user_page}'><img class='logo' src='media/logo.png' alt='Edmonton Sound Map'/></a>";
  
  echo "<a class='nav_item' href='{$logout_page}'>Logout</a>";
  

} else {
  
  echo "<a class='nav_item' href='{$register_page}'>Register</a>";

  echo "<a class='nav_item' href='{$public_page}'><img class='logo' src='media/logo.png' alt='Edmonton Sound Map'/></a>";
  

  echo "<a class='nav_item' href='{$login_page}'>Login</a>";

}

?>

</nav>  