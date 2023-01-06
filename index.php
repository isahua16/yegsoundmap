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
    <?php 
      show_msg();  
        ?>  
     
      <div class="content">
        <div id="map">&nbsp;</div>
        <div id="sidebar">
          <h2 class="title">Locations</h2>
        </div>
      </div>


      <!-- Info modal -->
      <div id="modal_faq" class="modal">
        <div class="modal_content_faq">
          <div class="faq_group">
            <button id="btn_close">close</button>
          </div>
        </div>
      </div>

      <!-- Splash screen -->
      <div class="intro">
        <h1 class="logo_splash">
          <span class="logo_span">edmonton</span><span class="logo_span">sound</span><span class="logo_span">map.</span>
        </h1>
      </div>  
      
      <script src="resources/index_script.js"></script>
  </body>
</html>
