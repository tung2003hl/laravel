{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>MAP</title>
  
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <style>
    body{
      margin:0;
      padding: 0;
    }
    #map{
      width:100%;
      height: 100vh;
    }
    .cordinate{
      position :f4;
      bottom: 50px;
      right:"50$;
    }
    leaflet-popup-content-wrapper
    {
      background-color:#000000;
      color:#fff;
      border:1px solid red;
      border-radius:0px;
    }
  </style>
</head>
<body>
  <div id="map"></div>
</body>

</html>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
  var map = L.map('map').setView([21.03361,105.77966], 13);

var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
});
osm.addTo(map);

//google street
googleStreets = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
});
googleStreets.addTo(map);

//Marker
var myIcon = L.icon({
      iconUrl:'img/red_marker.png',
      iconSize:[40,40],
});
var singleMarker = L.marker([21.03361,105.77966],{icon:myIcon,draggable: true});
var popup = singleMarker.bindPopup('this is IDS building' + singleMarker.getLatLng()).openPopup();
popup.addTo(map);

var secondMarker = L.marker([21.03361,104.77966],{icon:myIcon,draggable: true});


console.log(singleMarker.toGeoJSON());


var baseMaps = {
    "OSM": osm,
    'Google Map':googleStreets
};

var overlayMaps = {
    "First Marker": singleMarker,
    "Second Marker": secondMarker

};

map.removeLayer(singleMarker);

var layerControl = L.control.layers(baseMaps, overlayMaps,{collapsed:false}).addTo(map);

// L.geoJSON(pointJson).addTo(map)
// L.geoJSON(lineJson).addTo(map)

map.on('mouseover', function(){
   console.log('your mouese os over the map');
})
map.on('mousemove',function(e){
  console.log('lat: ' + e.latlng.lat,'lng: ' +e.latlng.lng11; )
})



</script> --}}


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Map</title>
  <style>
    body {
      margin: 0;
      padding: 0;

    }
    #map{
      width:100%;
      height:100vh;
    }
  </style>
</head>
<body>
  <div id="map"></div>
</body>
</html>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
  var map = L.map('map').setView([21.03361,105.77966], 6);

var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
});
osm.addTo(map);

if(!navigator.geolocation){
  console.log("Your browser doesn't support geolocation feature!")
} else {
  setInterval(() => {
    navigator.geolocation.getCurrentPosition(getPosition)
  },5000);

}

var marker,circle;

function getPosition(position){
  console.log(position)
  var lat = position.coords.latitude
  var long  = position.coords.longitude
  var accuracy = position.coords.accuracy

  if(marker){
    map.removeLayer(marker)
  }

  if(circle){
    map.removeLayer(circle)
  }



  marker = L.marker([lat,long])
  circle = L.circle([lat,long],{radius:accuracy})

  var featureGroup = L.featureGroup([marker,circle]).addTo(map)

  map.fitBounds(featureGroup.getBounds())



  console.log("Your coordinate is: Lat:"+ lat + " Long: "+ long + " Accuracy:" + accuracy)

}
</script>
