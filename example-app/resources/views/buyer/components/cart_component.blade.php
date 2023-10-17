
<section class="h-100 gradient-custom">
    <div class="container py-5">
      <div class="row d-flex justify-content-center my-4">
        <div class="col-md-8">
          @php
        $total = 0
    @endphp
          <div class="card mb-4">
            <div class="card-header py-3">
              <h5 class="mb-0">Cart - {{ $cartCount }} items</h5>
            </div>
            <div class="card-body update_cart_url" >
              <!-- Single item -->
              @if(isset($carts))
              @foreach($carts as $id=> $cartItem)
              <div class="row ">       
                
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
                  <p>Price: ${{number_format($cartItem['price'])}}</p>
            
                  <a href="{{route('delete.cart',[$id])}}" data-id="{{$id}}" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item">
                    <i class="fas fa-trash"></i>
                  </a>
                  
                  <button type="button" class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip"
                    title="Move to the wish list">
                    <i class="fas fa-heart"></i>
                  </button>
                  <!-- Data -->
                </div>
                @php
                  $total +=$cartItem['price'] * $cartItem['quantity'];
                @endphp
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                  <!-- Quantity -->
                  <form action="{{route('update.cart',$id)}}">
                  <div class="d-flex mb-4" style="max-width: 300px">
                        <button type="submit" class="btn btn-primary px-3 decrease-quantity" value="down" name="change_to"
                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                            <i class="fas fa-minus"></i> 
                        </button>
                    
                        <div class="form-outline">
                            <input id="quantityInput" min="1" name="quantity" value="{{$cartItem['quantity']}}" type="number" class="form-control quantity" />
                            <label class="form-label" for="quantityInput">Quantity</label>
                        </div>
                    
                        <button type="submit" class="btn btn-primary px-3 increase-quantity" value="up" name="change_to"
                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                            <i class="fas fa-plus"></i>
                        </button>
                  </div>
                  <!-- Quantity -->
  
                  <!-- Price -->
                  <p id="total" class="text-start text-md-center">
                    <strong>${{number_format($cartItem['price'] * $cartItem['quantity'])}}</strong>
                  </p>
                  <!-- Price -->
                </div>
              </form>
                <hr class="my-4" />
                
              </div>
              @endforeach
              @endif
              <div class="pt-5">
                <h6 class="mb-0"><a href="{{ url('/home') }}" class="text-body"><i
                      class="fas fa-long-arrow-alt-left me-2"></i>Continue Shopping</a></h6>
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
                  <span><strong>${{number_format($total) }}</strong></span>
                </li>
              </ul>
  
              <a href="{{ route('checkout') }}" class="btn btn-primary btn-lg btn-block">
                Go to checkout
            </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>