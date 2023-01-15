<nav class="header">
  <ul class="main_nav">

    <?php 
    if(logged_in()) {
      
      echo "<li class='nav_item'>Hello, <a class='username' href='#'>{$username}</a>!</li>";
      
      echo "<li class='nav_item' href='{$user_page}'><img class='logo' style='height:25, width:32' src='media/logo.png' alt='Edmonton Sound Map'/></li>";
      
      echo "<li> <a class='nav_item' href='{$logout_page}'>Logout</a></li>";
      
      
    } else {
      
      echo "<li> <a class='nav_item' href='{$register_page}'>Register</a></li>";
      
      echo "<li><a class='nav_item' href='{$public_page}'><img class='logo' src='media/logo.png' alt='Edmonton Sound Map'/></a></li>";
      
      echo "<li><a class='nav_item' href='{$login_page}'>Login</a></li>";
      
    }

    ?>
  </ul>

  <?php 
    show_msg();  
  ?>
       
</nav>
