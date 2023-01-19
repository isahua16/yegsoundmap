
<?php include "includes/init.php" ?>

<?php 
if (logged_in()) {
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
              value="<?php echo $username; ?>"
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
              <label for="terms"> I agree to the <a class="link-underline" href="https://docs.google.com/document/d/e/2PACX-1vSLD-abiEGpW679YSNpSKAqjBdLkiJC_6VXg3AkLi91MWujVz-KE1o3a89ILni-21vDum7-bDeYscIK/pub "target=”_blank”>terms and conditions</a> as set out by the user agreement</label>
            </div>
            
            <div class="file_upload">
              <label for="audio" class="custom_file_upload">
                <div id="custom_upload" class="button custom_upload">Upload</div></label>
              <input
              required
              type="file"
              id="audio"
              name="audio"
              accept=".wav, .mp3, .ogg, .m4a"
              />
              <button id="clear_file" class="clear_file button">x</button>
            </div>
              
              <div id="status"></div>
          </div>
          <button id="btn_save" class="button">Save</button>
          <button id="btn_cancel" class="button">Cancel</button>
        </div>
      </menu>
      
      <!-- Info modal -->
      <menu id="modal_faq" class="modal">
        <div class="modal_content_faq">
          <button id="btn_close" class="button">close</button></br>
          <div class="faq_group">
            <p>Edmonton sound map is a non-profit community initiative by local sound artists Isael Huard and Chris Szott. </p>
            <h3>Mission</h3>
            <p>The documentation and preservation of the aural identity of Edmonton through community contribution and collaboration.</p>
            <h3>Instructions</h3>
            <p>To submit a recording, right-click on the map at the location where the recording was made. On mobile, click and hold to get prompted with the submission form.</p>
            <h3>Technical requirements</h3>
            <p>Submit your recordings as .wav, .m4a, mp3 or .ogg files of 50 megabytes or less. Submissions judged to be of too poor quality (audio distortion, undistinguishable content, poor levels or overpowering handling noise) will be removed without warning. Recordings made with your phone, if carefully recorded, are welcome. We do not seek perfection. If in doubt, compare your recordings to others on the map.</p>
            <h3>Contact</h3>
            <p>If you wish to submit feedback or bugs you encounter with the website, as well as inquire about this initiative, please send an email at isaelhuard@gmail.com.</p>
            <h3>User agreement</h3>
            <p>You can review the user agreement <a href="https://docs.google.com/document/d/e/2PACX-1vSLD-abiEGpW679YSNpSKAqjBdLkiJC_6VXg3AkLi91MWujVz-KE1o3a89ILni-21vDum7-bDeYscIK/pub" target="_blank">here</a>.</p>
            <h3>Credits</h3>
            <ul id="credits">
              <li>Web development and design by Isael Huard</li>
              <li>Graphic design by Mason Beck</li>
            </ul>
          </div>
          <div class="socials_wrapper">
              <a href="https://www.instagram.com/yegsoundmap/" class="fa-brands fa-instagram"></a>
              <a href="https://twitter.com/YEGsoundmap" class="fa-brands fa-twitter"></a>
              <a href="#" class="fa-brands fa-discord"></a>
            </div>
        </div>
      </menu>
      <script src="resources/user_script.js"></script>
  </body>
</html>
