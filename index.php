<?php include "includes/init.php" ?>

<?php 
  if(logged_in()) {
    redirect('user.php');
  }
  ?>
  
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php" ?>
<title>Edmonton Sound Map</title>
<meta name="description" content="Explore the city of Edmonton, Canada through sound with recordings submitted by the community. Sign up now to contribute your recordings!">

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


      <!-- Info modal -->
      <menu id="modal_faq" class="modal">
        <div class="modal_content_faq">
          <button id="btn_close" class="button">close</button></br>
          <div class="faq_group">
            <p>Edmonton sound map is a non-profit community initiative by local sound artists Isael Huard and Chris Szott. </p>
            <h3>Mission</h3>
            <p>The documentation and preservation of the aural identity of Edmonton through community contribution and collaboration.</p>
            <h3>Contribute</h3>
            <p>In order to contribute your own recordings, you must register as a user and activate your account by email, as well as agree to the user agreement.</p>
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
      </menu>

      <!-- Splash screen -->
      <div class="intro">
        <h1 class="logo_splash">
          <span class="logo_span"><img class='logo_img_splash' src='media/logo.png' alt='Edmonton Sound Map'/>&nbsp;</span>
          <span class="logo_span" style="font-family: 'Montserrat Alternates', sans-serif;">edmonton&nbsp;sound&nbsp;map</span>
        </h1>
      </div> 
      <script src="resources/index_script.js"></script>
  </body>
</html>
