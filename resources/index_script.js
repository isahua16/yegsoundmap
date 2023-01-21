"use strict;";

//variables
let corner1,
  corner2,
  bounds,
  map,
  jawgLayer,
  myIcon,
  geojsonLayer,
  pop,
  btn,
  marker,
  poi,
  geocoder,
  faqBtn,
  sidebarBtn,
  intro,
  logoSplash,
  logoSpan;

////////////////////////////////////////////////////////////////////////////////////////

//Waits until all html and css before running the code
$(document).ready(function () {
  intro = document.querySelector(".intro");
  logoSplash = document.querySelector(".logo_splash");
  logoSpan = document.querySelectorAll(".logo_span");

  errorMessage = document.querySelector(".message_container");

  if (errorMessage != null) {
    document.querySelector("#map").classList.add("error");
    document.querySelector("#aside_scroll").classList.add("error2");
  }

  setTimeout(() => {
    logoSpan.forEach((span, idx) => {
      setTimeout(() => {
        span.classList.add("active");
      }, (idx + 1) * 400);
    });

    setTimeout(() => {
      logoSpan.forEach((span, idx) => {
        setTimeout(() => {
          span.classList.remove("active");
          span.classList.add("fade");
        }, (idx + 1) * 50);
      });
    }, 2000);

    setTimeout(() => {
      intro.style.top = "-100vh";
    }, 2300);
  });

  //Initialize leaflet map
  mapInit();
  //Max bounds init
  corner1 = L.latLng(53.88167850008248, -112.59475708007814);
  corner2 = L.latLng(53.207677555890015, -114.39376831054688);
  bounds = L.latLngBounds(corner1, corner2);

  map = L.map("map", { attributionControl: false, keyboard: false })
    .setView([53.53337, -113.50937], 11)
    .setMaxBounds(bounds);

  //Background Layer
  jawgLayer = L.tileLayer(
    "https://tile.jawg.io/2110036d-d2fc-47bb-92a1-b83946dca4f3/{z}/{x}/{y}{r}.png?access-token=8nDStn933xTbhSC1BHugLOD5N40As4Lkm1HFlYv22SBm6jAlIZReTwdLZiLHjnlu",
    {
      minZoom: 11,
    }
  );
  map.addLayer(jawgLayer);

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
    errorMessage: "No result",
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

  faqBtn = L.easyButton(
    `<img src="media/info-solid.svg" width="22px" height="22px" style="padding-top: 5px" class="icon-faq">`,
    function (btn, map) {
      $("#modal_faq").show();
    }
  ).addTo(map);

  sidebarBtn = L.easyButton(
    `<img src="media/caret-left-solid.svg" width="22px" height="22px" style="padding-top: 5px" class="icon-faq">`,
    function (btn, map) {
      $("#sidebar").toggle();
    }
  )
    .setPosition("topright")
    .addTo(map);

  if ($(window).width() < 800) {
    sidebarBtn.disable();
  } else {
    sidebarBtn.enable();
  }
});

//Checks screen resize events and updates the sidebar button accordingly
$(window).on("resize", function () {
  if ($(window).width() < 800) {
    $("#sidebar").hide();
    sidebarBtn.disable();
  } else {
    sidebarBtn.enable();
  }
});

//Adds and event listener to close the FAQ modal
$("#btn_close").click(function () {
  $("#modal_faq").hide();
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

//Zoom on geocoding result
function onGeocodingResult() {
  geocoder
    .on("markgeocode", function (e) {
      const center = e.geocode.center;
      map.setView(center, 17);
    })
    .addTo(map);
}

// Create markers from GeoJson
function myCreateEachMarkerFunction(feature, latlng) {
  btn = `<button style="width:97%;" id="zoomTo` + feature.properties.id;
  btn += `" class="location">`;
  btn += feature.properties.name + `</button>`;
  $("#aside_scroll").append(btn);

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
      controlslist="nodownload noremoteplayback noplaybackrate" autoplay="true"
      src="` +
    feature.properties.audio +
    `"><a href="` +
    feature.properties.audio +
    `"></a>
      </audio></div>`
  );
}
