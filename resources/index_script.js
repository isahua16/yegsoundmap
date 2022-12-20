"use strict;";

//variables
let corner1,
  corner2,
  bounds,
  map,
  tile,
  myIcon,
  geojsonLayer,
  pop,
  marker,
  poi,
  sidebar;

////////////////////////////////////////////////////////////////////////////////////////

//Waits until all html and css before running the code
$(document).ready(function () {
  mapInit();
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
});

function mapInit() {
  $.ajax({
    url: "load_poi.php",
    success: function (response) {
      if (poi) {
        map.removeLayer(poi);
        $("#sidebar").html("");
      }
      poi = L.geoJSON(JSON.parse(response), {
        pointToLayer: myCreateEachMarkerFunction,
        onEachFeature: myOnEachFeatureFunction,
      });
      poi.addTo(map);
    },
  });
}

// Create markers from GeoJson
function myCreateEachMarkerFunction(feature, latlng) {
  btn = `<button id="zoomTo` + feature.properties.id;
  btn += `" class="location">`;
  btn += feature.properties.name + `</button>`;
  $("#sidebar").append(btn);

  //Add Zoom buttons for each feature
  $("#zoomTo" + feature.properties.id).click(function () {
    map.setView([latlng.lat, latlng.lng], 17);
    map.openPopup(setPopupContent(feature), latlng);
  });

  marker = L.marker(latlng, { icon: myIcon });

  marker.on("popupopen", function () {
    map.setView([latlng.lat, latlng.lng], 17);
  });

  return marker;
}

//Bind popup content for each feature
function myOnEachFeatureFunction(feature, layer) {
  layer.bindPopup(setPopupContent(feature));
}

//Create popup content
function setPopupContent(feature) {
  return (
    `<div class="popup">
    <h3>` +
    feature.properties.name +
    `</h3><br><p>` +
    feature.properties.date +
    `</p><br><p>` +
    feature.properties.description +
    `</p><br><audio class="audio"
      controls
      controlslist="nodownload noremoteplayback noplaybackrate"
      src="` +
    feature.properties.audio +
    `"><a href="` +
    feature.properties.audio +
    `"></a>
      </audio></div>`
  );
}

// Add dynamic sidebar for the locations tab
// sidebar = L.control.sidebar("sidebar", {
//   position: "right",
// });

// map.addControl(sidebar);

// setTimeout(function () {
//   sidebar.show();
// }, 500);
