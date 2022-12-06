"use strict;";

//variables
let corner1, corner2, bounds, map, tile, myIcon, zoomBtn, geojsonLayer, str;

////////////////////////////////////////////////////////////////////////////////////////

//Waits until all html and css before running the code
$(document).ready(function () {
  //Max bounds init
  corner1 = L.latLng(53.88167850008248, -112.59475708007814);
  corner2 = L.latLng(53.207677555890015, -114.39376831054688);
  bounds = L.latLngBounds(corner1, corner2);

  //Map init
  map = L.map("map", { attributionControl: false })
    .setView([53.5461, -113.4937], 11)
    .setMaxBounds(bounds);

  //Background Layer
  tile = L.tileLayer(
    "https://tile.jawg.io/e5ca48b4-fe5e-4dea-9141-1971ed06c7af/{z}/{x}/{y}{r}.png?access-token=8nDStn933xTbhSC1BHugLOD5N40As4Lkm1HFlYv22SBm6jAlIZReTwdLZiLHjnlu",
    { minZoom: 11 }
  );
  map.addLayer(tile);

  //Marker Icon
  myIcon = L.icon({
    iconUrl: "media/logo.png",
    iconSize: [20, 20],
  });

  //Sidebar Button Zoom
  zoomBtn = $("#zoomToLocation").on("click", function () {
    map.setView([53.519794596542546, -113.49060757891392], 17);
  });

  // Add GeoJSON layer
  geojsonLayer = new L.GeoJSON.AJAX("data/attractions.geojson", {
    pointToLayer: function (feature, latlng) {
      str = `<h3>` + feature.properties.name + `</h3><br>`;
      str +=
        `<audio class="audio"
        controls
        controlslist="nodownload noremoteplayback noplaybackrate"
        src="` +
        feature.properties.audio +
        `">
        <a href="` +
        feature.properties.audio +
        `"></a>
        </audio>`;
      return L.marker(latlng, { icon: myIcon }).bindPopup(str);
    },
  });
  geojsonLayer.addTo(map);
});

////////////////////////////////////////////////////////////////////////////////////////
//Create a marker (and bind a popup directly)

// const marker = L.marker([53.519794596542546, -113.49060757891392], {
//   icon: myIcon,
// })
//   .bindPopup(
//     `
//     <h3>Holy Trinity Anglican Church Walla</h3>
//     <br>
//     <audio class="audio"
//       controls
//       controlslist="nodownload noremoteplayback noplaybackrate"
//       src="media/Walla_church_echo_inside_english_large_isael.wav"
//     >
//       <a href="media/Walla_church_echo_inside_english_large_isael.wav"></a>
//     </audio>
//     `
//   )
//   .addTo(map)
//   .openPopup();

////////////////////////////////////////////////////////////////////////////////////////
//Create a marker on map click
/* 
          function onMapClick(event) {
            let coordinates = event.latlng;
            L.marker(coordinates).addTo(map);
          }
          map.on("click", onMapClick);
          */

////////////////////////////////////////////////////////////////////////////////////////
