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
          <div class="faq_group">
            <button id="btn_close" class="button">close</button>
          </div>
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
