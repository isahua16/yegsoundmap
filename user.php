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
<title>Member View - Edmonton Sound Map</title>
<meta name="description" content="Submit your own field recordings to Edmonton Sound Map.">
<meta name=”robots” content="noindex, follow">
</head>
  <body> 
    <?php include "includes/nav.php" ?>
      <main class="content">
        <section id="map"></section>
        <aside id="sidebar">
          <h2 class="title">Locations</h2>
          <div id="aside_scroll">
          </div>
        </aside>
      </main>
      <!-- Submission modal  -->
      <menu id="modal_form" class="modal">
        <div class="modal_content_submission">
          <div class="form_fields">
          <h2> Submission form </h2>          
          <label for="user">Recordist name</label>  
          <input
              required
              type="text"
              class="field"
              id="user"
              value="<?php echo $username ?>"
            />          
          <label for="name">Location</label> 
          <input
              required
              type="text"
              class="field"
              id="name"
            />            
            <label for="description">Description (weather, time, event, etc.)</label>
            <textarea rows="5" cols="10" 
              required
              class="field"
              id="description" style="resize: none;"></textarea>           
            <label for="date">Date recorded</label> 
            <input required type="date" class="field" id="date" />
            <input
              required
              type="text"
              class="field"
              id="latitude"
            />
            <input
              required
              type="text"
              class="field"
              id="longitude"
            />
            <div class="agree">
              <input
                required
                type="checkbox"
                class="field"
                id="terms"
                value="1"
              />
              <label for="terms"> I agree to the <a class="link" href="<?php echo $user_page;?> "target=”_blank”>terms and conditions</a> as set out by the user agreement</label>
            </div>
            
            <div class="file_upload">
              <label for="audio" class="custom_file_upload">
                <div class="button custom_upload">Upload</div></label>
              <input
              required
              type="file"
              id="audio"
              name="audio"
              accept=".wav, .mp3, .ogg, .m4a"
              />
              <button class="clear_file button">x</button>
            </div>
              
              <div id="status"></div>
          </div>
          <button id="btn_save" class="button">Save</button>
          <button id="btn_cancel" class="button">Cancel</button>
        </div>
      </menu>
      
      <!-- Info modal -->
      <div id="modal_faq" class="modal">
        <div class="modal_content_faq">
          <div class="faq_group">
            <button id="btn_close" class="button" >close</button>
          </div>
        </div>
      </div>  
      <script src="resources/user_script.js"></script>
  </body>
</html>
