<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sauve Cart</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    .gradient-custom {
/* fallback for old browsers */
background: #6a11cb;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
}
  </style>
</head>
<body>
  @php
      $total = 0
  @endphp
<section class="h-100 gradient-custom">
  <div class="container py-5">
    <div class="row d-flex justify-content-center my-4">
      <div class="col-md-8">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Cart - 2 items</h5>
          </div>
          <div class="card-body">
            <!-- Single item -->
            <div class="row">
              @foreach($carts as $cartItem)
              @php
                $total +=$cartItem['price'] * $cartItem['quantity'];
              @endphp

              <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                <!-- Image -->
                <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                  <img style="width:220px;height:220px" src="{{ asset('storage/images/'.$cartItem['image']) }}"
                    class="w-100" alt="Blue Jeans Jacket" />
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                  </a>
                </div>
                <!-- Image -->
              </div>

              <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                <!-- Data -->
                <p><strong>{{$cartItem['name']}}</strong></p>
                <p>Price: ${{$cartItem['price']}}</p>
                
                <a href="#" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item">
                  <i class="fas fa-trash"></i>
                </a>
                <button type="button" class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip"
                  title="Move to the wish list">
                  <i class="fas fa-heart"></i>
                </button>
                <!-- Data -->
              </div>

              <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <!-- Quantity -->
                <div class="d-flex mb-4" style="max-width: 300px">
                  <button class="btn btn-primary px-3 me-2 decrease-quantity"
                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                    <i class="fas fa-minus"></i>
                  </button>

                  <div class="form-outline">
                    <input id="form1" min="1" name="quantity" value="{{$cartItem['quantity']}}" type="number" class="form-control" />
                    <label class="form-label" for="form1">Quantity</label>
                  </div>

                    <button class="btn btn-primary px-3 ms-2 increase-quantity"
                      onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                      <i class="fas fa-plus"></i>
                    </button>
                </div>
                <!-- Quantity -->

                <!-- Price -->
                <p id="total-price" class="text-start text-md-center">
                  <strong>${{number_format($cartItem['price'] * $cartItem['quantity'])}}</strong>
                </p>
                <!-- Price -->
              </div>
              <hr class="my-4" />
              @endforeach
              
            </div>
            <div class="pt-5">
              <h6 class="mb-0"><a href="{{ url('/home') }}" class="text-body"><i
                    class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
            </div>
            <!-- Single item -->

          </div>
        </div>
        <div class="card mb-4">
          <div class="card-body">
            <p><strong>Expected shipping delivery</strong></p>
            <p class="mb-0">12.10.2020 - 14.10.2020</p>
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body">
            <p><strong>We accept</strong></p>
            <img class="me-2" width="45px"
              src="asset('https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg')"
              alt="Visa" />
            <img class="me-2" width="45px"
              src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
              alt="American Express" />
            <img class="me-2" width="45px"
              src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
              alt="Mastercard" />
            <img class="me-2" width="45px"
              src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.webp"
              alt="PayPal acceptance mark" />
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Summary</h5>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li
                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                Products
                <span>{{number_format($total) }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                Shipping
                <span>Gratis</span>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                <div>
                  <strong>Total amount</strong>
                  <strong>
                    <p class="mb-0">(including VAT)</p>
                  </strong>
                </div>
                <span><strong>$53.98</strong></span>
              </li>
            </ul>

            <button type="button" class="btn btn-primary btn-lg btn-block">
              Go to checkout
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
  $(document).ready(function() {
      // Lắng nghe sự kiện click trên nút "Trừ"
      $('.decrease-quantity').click(function() {
          // Lấy giá trị số lượng hiện tại
          var quantityInput = $(this).siblings('.quantity-input');
          var currentQuantity = parseInt(quantityInput.val());

          // Giảm số lượng đi 1 đơn vị nếu nó lớn hơn 1
          if (currentQuantity > 1) {
              currentQuantity--;
              quantityInput.val(currentQuantity);
          }

          // Cập nhật tổng tiền
          updateTotalPrice(quantityInput);
      });

      // Lắng nghe sự kiện click trên nút "Cộng"
      $('.increase-quantity').click(function() {
          // Lấy giá trị số lượng hiện tại
          var quantityInput = $(this).siblings('.quantity-input');
          var currentQuantity = parseInt(quantityInput.val());

          // Tăng số lượng lên 1 đơn vị
          currentQuantity++;
          quantityInput.val(currentQuantity);

          // Cập nhật tổng tiền
          updateTotalPrice(quantityInput);
      });

      // Hàm cập nhật tổng tiền
      function updateTotalPrice(quantityInput) {
          var quantity = parseInt(quantityInput.val());
          var pricePerItem = parseFloat(quantityInput.closest('.product-quantity').data('price')); // Đặt giá tiền cho mỗi sản phẩm ở đây

          // Tính tổng tiền cho sản phẩm
          var totalPrice = quantity * pricePerItem;

          // Cập nhật giá trị tổng tiền
          var totalPriceElement = quantityInput.closest('.product-quantity').siblings('.text-start.text-md-center').find('strong');
          totalPriceElement.text('$' + totalPrice.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')); // Định dạng số thành tiền tệ, thêm dấu ',' ngăn cách hàng nghìn
      }
  });
</script>
</body>
</html>