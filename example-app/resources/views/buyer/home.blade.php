<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Sauve Dinner</title>
</head>
<body>
  @extends('layouts.app')

@section('content')

<section style="background-color: #eee;">  
  <div class="container py-5 text-center">
    <div class="containerr"> 
      <h3>Where should we delivery your food today?</h3>
      <form action="{{route('shop.address')}}" method="POST">
      <input type="text" name="location" id="location" class="input-box" placeholder="Enter your address">
      <button type="submit">Tìm kiếm</button>
      </form>
      <button id="getAddressButton">Nhận Địa Chỉ</button>
    </div>
    
    @if(request()->is('home'))
    <h1 class="display-4"><strong>Bestsellers</strong></h1>
    @elseif(request()->is('food'))
    <h1 class="display-4"><strong>Food</strong></h1>
    @elseif(request()->is('drink'))
    <h1 class="display-4"><strong>Drink</strong></h1>
    @elseif(request()->is('flower'))
    <h1 class="display-4"><strong>Flower</strong></h1>
    @elseif(request()->is('market'))
    <h1 class="display-4"><strong>Market</strong></h1>
    @endif
  <!-- Phần 3 -->
  <div class="search-container center">
    <!-- Biểu tượng tìm kiếm -->
    <div class="search-icon">
        <a href="#" id="searchButton"><i style="color: blue" class="fas fa-search"></i></a>
    </div>
    <!-- Form tìm kiếm -->
    <input type="text" class="search-input" name="searchTerm" placeholder="Tìm kiếm...">
  </div>

    
  
  
    <div class="row">
    @foreach ($food as $food)
      <div class="col-lg-4 col-md-12 mb-4">
        <div class="card">
          <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
            data-mdb-ripple-color="light">
            <a href="{{ route('shop.detail', ['shop_id' => $food->shop_id]) }}">
            <img style="height:275px;width:275px" src="{{ asset('storage/images/'.$food->image_url) }}"
              class="w-100" />
            
              <div class="mask">
                <div class="d-flex justify-content-start align-items-end h-100">
                  <h5><span class="badge bg-primary ms-2">New</span></h5>
                </div>
              </div>
              <div class="hover-overlay">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </div>
            </a>
          </div>
          <div class="card-body">
            <a href="{{ route('shop.detail', ['shop_id' => $food->shop_id]) }}" class="text-reset">
              <h5 class="card-title mb-3">{{$shopName[$food->shop_id]}}-{{$food->name}}</h5>
            </a>
            <a href="" class="text-reset">
              <p>{{$food->category_name}}</p>
            </a>
            <h6 class="mb-3">${{$food->price}}</h6>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBY5p5e5PtJuJLI_nRpjefL0S094jdhEP8&libraries=places"></script>
<script>
    $(document).ready(function () {
        $('#searchButton').on('click', function (e) {
            e.preventDefault(); // Ngăn chặn hành động mặc định của thẻ <a>

            // Gửi form
            $('#searchForm').submit();
        });
    });
</script>
{{-- <script>
  $(document).ready(function(){
    var autocomplete;
    var to ='location';
    autocomplete = new google.maps.places.Autocomplete((document.getElementById(to)),{
      type : ['geocode'],
    });
  });
</script> --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

</body>
</html>
<script>
 $(document).ready(function() {
    $('#getAddressButton').click(function() {
      if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function(position) {
          var userLat = position.coords.latitude;
          var userLng = position.coords.longitude;

          // Gửi yêu cầu API để lấy địa điểm
          fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${userLat}&lon=${userLng}`)
            .then(response => response.json())
            .then(data => {
              var address = data.display_name; // Đây là địa điểm tương ứng với vị trí

              // Cập nhật giá trị của trường nhập với địa chỉ
              $('#location').val(address);
              console.log(address);
            })
            .catch(error => {
              console.error("Lỗi khi lấy địa điểm:", error);
            });
        });
      } else {
        console.log("Geolocation không có sẵn trong trình duyệt của bạn.");
      }
    });
  });
</script>