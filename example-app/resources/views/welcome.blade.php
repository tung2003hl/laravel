{{-- hiển thị map --}}
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

{{-- hiển thị vị trí hiện tại  --}}
{{-- <!DOCTYPE html>
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
</script> --}}

{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Routing app</title>
  <style>
    body{
      margin:0;
      padding:0;
    }
  </style>
</head>
<body>
    <div id="map" style="width:100%;height: 100vh"></div>
</body>

</html>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

<script>
  window.onload = function() {
  var map = L.map('map').setView([21.03361,105.77966],11);
  var tileLayer = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png',{attribution: "OSM"}).addTo(map);
  googleStreets = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
});
googleStreets.addTo(map);
if ("geolocation" in navigator) {
  navigator.geolocation.getCurrentPosition(function(position) {
    var userLat = position.coords.latitude;
    var userLng = position.coords.longitude;

    // Gửi yêu cầu API để lấy địa điểm
    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${userLat}&lon=${userLng}`)
      .then(response => response.json())
      .then(data => {
        var address = data.display_name; // Đây là địa điểm tương ứng với vị trí
        // Sử dụng thông tin địa điểm theo cách bạn cần
        console.log(address);
      })
      .catch(error => {
        console.error("Lỗi khi lấy địa điểm:", error);
      });
  });
}
    }
</script> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
      .product-list {
          list-style: none;
          padding: 0;
          margin: 0;
      }

      .product-item {
          border: 1px solid #ccc;
          margin-bottom: 10px;
          padding: 10px;
      }
  </style>
</head>

<body>

<div class="product-container">
    <img src="your-product-image.jpg" alt="Product Image" class="product-image" />
    <span class="wishlist-icon" id="wishlistIcon">&#x2665;</span>
    <div class="wishlist-popup" id="wishlistPopup">
      <ul class="product-list">
    <li class="product-item">
        <h3>Sản phẩm 1</h3>
        <p>Giá: $10.00</p>
    </li>
    <li class="product-item">
        <h3>Sản phẩm 2</h3>
        <p>Giá: $20.00</p>
    </li>
    <!-- Thêm các mục cho các sản phẩm khác -->
</ul>
    </div>
</div>

<script>
    
$(document).ready(function () {
    $(".wishlist-icon").on({
        mouseenter: function () {
            $(".wishlist-popup").show();
        },
        mouseleave: function () {
            $(".wishlist-popup").hide();
        }
    });
});

</script>
<script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>

</body>
</html>

