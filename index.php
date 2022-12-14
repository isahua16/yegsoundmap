<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php" ?>
  <body>
    <div class="container">    
    <?php include "includes/nav.php" ?>     
      <div class="content">
        <div id="map">&nbsp;</div>
        <div id="sidebar">
          <h2 class="title">Locations</h2>
        </div>
      </div>

      <div id="modal" class="modal">
        <div class="modal_content">
          <div class="form_group">
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
              type="file"
              id="audio"
              name="audio"
              accept=".wav, .mp3, .ogg"
            />
          </div>
          <button id="btn_save">Save</button>
          <button id="btn_cancel">Cancel</button>
        </div>
      </div>
      <!-- Map Javascript -->
      <script src="js/script.js"></script>
    </div>
  </body>
</html>
