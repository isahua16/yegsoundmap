"use strict;";

//variables
let corner1,
  corner2,
  bounds,
  map,
  tile,
  myIcon,
  zoomBtn,
  geojsonLayer,
  pop,
  btn,
  marker;

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

  // Add GeoJSON layer
  geojsonLayer = new L.GeoJSON.AJAX("data/attractions.geojson", {
    pointToLayer: function (feature, latlng) {
      //Add a button for each feature
      btn = `<button id="zoomTo` + feature.properties.name.replace(/ /g, "");
      btn += `" class="location">`;
      btn += feature.properties.name + `</button>`;
      $("#sidebar").append(btn);

      //Zoom to marker when clicking button
      $("#zoomTo" + feature.properties.name.replace(/ /g, "")).click(
        function () {
          map.setView([latlng.lat, latlng.lng], 17);
        }
      );

      // Add a custom popup for each feature
      pop = `<h3>` + feature.properties.name + `</h3><br>`;
      pop +=
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

      marker = L.marker(latlng, { icon: myIcon }).bindPopup(pop);
      marker.on("popupopen", function () {
        map.setView([latlng.lat, latlng.lng], 17);
      });

      return marker;
    },
  });
  geojsonLayer.addTo(map);
});

//////////////////////////////////////////////////////////////

//Create a marker on map click
/* 
          function onMapClick(event) {
            let coordinates = event.latlng;
            L.marker(coordinates).addTo(map);
          }
          map.on("click", onMapClick);
          */

//////////////////////////////////////////////////////////////
