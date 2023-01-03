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
  btn,
  marker,
  poi,
  formData,
  sidebar,
  geocoder;

////////////////////////////////////////////////////////////////////////////////////////

//Waits until all html and css before running the code
$(document).ready(function () {
  mapInit();
  //Max bounds init
  corner1 = L.latLng(53.88167850008248, -112.59475708007814);
  corner2 = L.latLng(53.207677555890015, -114.39376831054688);
  bounds = L.latLngBounds(corner1, corner2);

  map = L.map("map", { attributionControl: false })
    .setView([53.5461, -113.4937], 11)
    .setMaxBounds(bounds);

  //Background Layer
  tile = L.tileLayer(
    "https://tile.jawg.io/e5ca48b4-fe5e-4dea-9141-1971ed06c7af/{z}/{x}/{y}{r}.png?access-token=8nDStn933xTbhSC1BHugLOD5N40As4Lkm1HFlYv22SBm6jAlIZReTwdLZiLHjnlu",
    {
      minZoom: 11,
    }
  );
  map.addLayer(tile);

  //Marker Icon
  myIcon = L.icon({
    iconUrl: "media/logo.png",
    iconSize: [20, 20],
  });

  //create geocoding search bar
  geocoder = L.Control.geocoder({
    position: "topright",
    collapsed: true,
    placeholder: "Search...",
    defaultMarkGeocode: false,
    errorMessage: "No result. Try right-clicking at desired location.",
    geocoder: new L.Control.Geocoder.Nominatim({
      geocodingQueryParams: {
        countrycodes: "CA",
        viewbox: "-112.59, 53.88, -114.39, 53.21",
        bounded: 1,
      },
    }),
  });

  geocoder.addTo(map);

  onGeocodingResult();
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
      map.on("contextmenu", onRightClick);
      $("#btn_cancel").click(cancelBtnFunction);
      $("#btn_save").click(sendDataToServer);
    },
  });
}

//Submit data on save button click
function sendDataToServer() {
  if (
    $("#latitude").val() === "" ||
    $("#longitude").val() === "" ||
    $("#name").val() === "" ||
    $("#audio").val() === "" ||
    $("#date").val() === "" ||
    $("#description").val() === "" ||
    $("#user").val() === "" ||
    $("#terms").val() === ""
  ) {
    alert("Please fill in all the fields");
  } else {
    //Prepare form data to be sent thru ajax call
    formData = new FormData($("form[id='poi_submission']")[0]);

    formData.append("poi", $("#audio")[0].files[0]);
    formData.append("latitude", $("#latitude").val());
    formData.append("longitude", $("#longitude").val());
    formData.append("name", $("#name").val());
    formData.append("audio", $("#audio").val());
    formData.append("date", $("#date").val());
    formData.append("description", $("#description").val());
    formData.append("user", $("#user").val());
    formData.append("terms", $("#terms").val());

    $.ajax({
      url: "add_poi.php",
      type: "POST",
      contentType: false,
      processData: false,
      cache: false,
      data: formData,
      xhr: function () {
        const xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener(
          "progress",
          function (evt) {
            if (evt.lengthComputable) {
              let percentComplete = evt.loaded / evt.total;
              console.log(percentComplete);
              $("#status").html(
                `Uploading -> ` + Math.round(percentComplete * 100) + `%`
              );
            }
          },
          false
        );
        return xhr;
      },
      success: function (response) {
        $("#status").html("Upload complete");
        $("#audio").val("");
        mapInit();
        cancelBtnFunction();
      },
    });
  }
}

// Hide modal form on cancel button click
function cancelBtnFunction() {
  $("#modal_form").hide();
  $("#description").val("");
  $("#status").html("");
}

//Modal popup on geocoding result
function onGeocodingResult() {
  geocoder
    .on("markgeocode", function (e) {
      const center = e.geocode.center;
      map.setView(center, 17);
    })
    .addTo(map);
}

// Modal popup on right click of map
function onRightClick(e) {
  $("#modal_form").show();
  $("#latitude").val(e.latlng.lat.toFixed(5));
  $("#longitude").val(e.latlng.lng.toFixed(5));

  geocoder.options.geocoder.reverse(
    e.latlng,
    map.options.crs.scale(map.getZoom()),
    function (results) {
      $("#name").val(results[0].name);
    }
  );
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
    `</h3><p> Recorded by ` +
    feature.properties.userd +
    ` on ` +
    feature.properties.date +
    `</p><p>` +
    feature.properties.description +
    `</p><audio class="audio"
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
