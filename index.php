<?php include "includes/init.php" ?>

<?php 
  if(logged_in()) {
    redirect('user.php');
  }
  ?>
  
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php" ?>
  <body>
    <div class="container">  
    <?php include "includes/nav.php" ?>
    <?php 
      show_msg();  
        ?>       
      <div class="content">
        <div id="map">&nbsp;</div>
        <div id="sidebar">
          <h2 class="title">Locations</h2>
        </div>
      </div>

      <!-- welcome modal -->
      <div id="modal_welcome" class="modal">
        <div class="modal_content">
          <div class="form_group">
          <img src="media/logo_with_text.png" alt="logo" class="logo" />
            <button id="btn_close_modal">Take me to the map</button>
            <button id="btn_login">I am to upload my sounds</button>
          </div>
        </div>
      </div>
      <!-- Sidebar Javascript -->
      <script src="resources/L.Control.Sidebar.js"></script>
      
      <!-- Map Javascript -->
      <script src="resources/index_script.js"></script>
    </div>
  </body>
</html>
