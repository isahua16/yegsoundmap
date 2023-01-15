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
    <?php include "includes/nav.php" ?>
      <div class="content">
        <div id="map"></div>
        <div id="sidebar">
          <h2 class="title">Locations</h2>
        </div>
      </div>


      <!-- Info modal -->
      <div id="modal_faq" class="modal">
        <div class="modal_content_faq">
          <div class="faq_group">
            <button id="btn_close" class="button">close</button>
          </div>
        </div>
      </div>

      <!-- Splash screen -->
      <div class="intro">
        <h1 class="logo_splash">
          <span class="logo_span"><img class='logo_img_splash' src='media/logo.png' alt='Edmonton Sound Map'/>&nbsp;</span>
          <span class="logo_span">edmonton&nbsp;sound&nbsp;map</span>
        </h1>
      </div>  
      
      <script src="resources/index_script.js"></script>
  </body>
</html>
