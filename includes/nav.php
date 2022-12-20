<nav class="header">

<?php 

if(logged_in()) {

  echo "<a href='http://localhost/yegsoundmap/user.php'>@yegsoundmap</a>";

  echo "Hello, {$username}!";

  echo "<a href='http://localhost/yegsoundmap/logout.php'>Logout</a>";


} else {

  echo "<a href='http://localhost/yegsoundmap/index.php'>@yegsoundmap</a>";

  echo "<a href='http://localhost/yegsoundmap/register.php'>Register</a>";

  echo "<a href='http://localhost/yegsoundmap/login.php'>Login</a>";

}

?>
  <img src="media/logo.png" alt="logo" class="logo" />
</nav>

      