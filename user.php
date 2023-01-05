<!-- For signed in users only, need to be signed in to access this page which has the contribute functionalities -->

<?php include "includes/init.php" ?>

<?php 
  if(logged_in()) {
    $username = $_SESSION['username'];
  } else {  
      redirect('index.php');    
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
        <div id="map"></div>
        <div id="sidebar">
          <h2 class="title">Locations</h2>
        </div>
      </div>

      <div id="modal_form" class="modal">
        <div class="modal_content">
          <div class="form_group">
          <input
              required
              type="text"
              class="field"
              id="user"
              value="<?php echo $username ?>"
              placeholder="Contributor Name"
            />  
          
          <input
              required
              type="text"
              class="field"
              id="name"
              placeholder="Location Name"
            />

            <input
              required
              type="textarea"
              class="field"
              id="description"
              placeholder="Description (Weather, Time, Event, etc.)"
            />

            <input required type="date" class="field" id="date" />

            <input
              required
              type="text"
              class="field"
              id="latitude"
              placeholder="Latitude"
            />

            <input
              required
              type="text"
              class="field"
              id="longitude"
              placeholder="Longitude"
            />

            <input
              required
              type="checkbox"
              
              class="field"
              id="terms"
              value="1"
            />
            <label for="terms"> I agree to the <a href="<?php echo $user_page;?> "target=”_blank”>terms and conditions</a>as set out by the user agreement</label>

            <input
              required
              type="file"
              id="audio"
              name="audio"
              accept=".wav, .mp3, .ogg, .m4a"
              />
              <div id="status"></div>
          </div>
          <button id="btn_save">Save</button>
          <button id="btn_cancel">Cancel</button>
        </div>
      </div>
      
      <!-- welcome modal -->
      <div id="modal_faq" class="modal">
        <div class="modal_content">
          <div class="form_group">
            <button id="btn_close">close</button>
          </div>
        </div>
      </div>

      <div class="intro">
        <h1 class="logo_splash">

          <span class="logo_span">edmonton </span><span class="logo_span">sound </span><span class="logo_span"> map.</span>
        </h1>
        </div>
        
  
      <!-- Map Javascript -->
      <script src="resources/user_script.js"></script>

    
  </body>
</html>
