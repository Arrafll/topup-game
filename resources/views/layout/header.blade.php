<!-- Header Section starts -->
<header class="header-main">
  <div class="container-fluid">
    <div class="row">
      <div class="col-6 col-sm-4 d-flex align-items-center header-left p-0">
        <span class="header-toggle me-3">
          <i class="ph ph-circles-four"></i>
        </span>
        @if ($role == 1 && Route::is('admin'))
        <div class="col-sm-3">
          <select class="form-select" id="dashboard-year-filter">
          <option value="" selected>Tahun</option>
          @foreach ($years as $y)
        <option value="{{ $y->year }}">{{ $y->year }}</option>
        @endforeach
          </select>
        </div>
    @endif
      </div>
      <div class="col-6 col-sm-8 d-flex align-items-center justify-content-end header-right p-0">

        <ul class="d-flex align-items-center">

          @if ($role == 2)
        <li class="header-cart">
        <a href="#" class="d-block head-icon position-relative" role="button" data-bs-toggle="offcanvas"
          data-bs-target="#cartcanvasRight" aria-controls="cartcanvasRight">
          <i class="ph ph-shopping-cart-simple"></i>
          <span class="position-absolute translate-middle badge rounded-pill bg-danger badge-notification"
          id="cartCounts">{{ ($cartList->count()) }}</span>
        </a>
        <div class="offcanvas offcanvas-end header-cart-canvas" tabindex="-1" id="cartcanvasRight"
          aria-labelledby="cartcanvasRightLabel">
          <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="cartcanvasRightLabel">Cart</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body app-scroll p-0">
          <div class="head-container" id="headContainerCart">
            @foreach ($cartList as $cl)

        <div class="head-box">
        <img src="{{ asset('uploads/product/' . $cl->product_pic) }}" alt="cart"
          class="h-50 object-fit-cover me-3 b-r-10">
        <div class="flex-grow-1">
          <a class="mb-0 f-w-600 f-s-16" href="product_details.html" target="_blank">
          {{ $cl->name }}</a><br>
          <span class="text-secondary text-dark f-w-400">{{ $cl->game }}</span><br>
          <span class="text-secondary">{{ $cl->package_amount }} {{ $cl->unit }} - <span
          class="text-dark f-w-400 row-cart-price"
          data-price="{{ $cl->product_price }}">{{ toCurrency($cl->product_price, 'IDN') }}</span></span>
        </div>
        <div class="text-end">
          <i class="ph ph-trash f-s-25 text-danger" data-cart="{{ $cl->cart_id }}"
          onclick="removeCart(this)"></i>

        </div>
        </div>

        @endforeach
            <div class="hidden-massage py-4 px-3" id="emptyCartMessage">
            <img src="{{ asset('assets/images/icons/cart.png') }}" alt="cart" class="w-50 h-50 mb-3">
            <div>
              <h6 class="mb-0">Keranjang Kosong!</h6>
              <p class="text-secondary mb-0">Ayo beli beberapa produk :)</p>
              <a class="btn btn-light-primary btn-xs mt-2" href="/customer_product_list">Belanja Sekarang</a>
            </div>
            </div>
          </div>
          </div>
          <div class="offcanvas-footer">
          <div class="head-box-footer p-3">
            <div class="mb-4">
            <h6 class="text-muted f-w-600">Total <span class="float-end" id="cartTotalCounts"
              data-total="{{ $cartList->sum('product_price') }}">{{ toCurrency($cartList->sum('product_price'), 'IDN') }}
              </span></h6>
            </div>
            <div class="header-cart-btn">
            <a href="/customer_order_cart" role="button" class="btn btn-light-success">
              Buat Pesanan</i></a>
            </div>
          </div>
          </div>
        </div>
        </li>
      @endif
          <li class="header-dark">
            <div class="sun-logo head-icon">
              <i class="ph ph-moon-stars"></i>
            </div>
            <div class="moon-logo head-icon">
              <i class="ph ph-sun-dim"></i>
            </div>
          </li>

          <li class="header-profile">
            <a href="#" class="d-block head-icon" role="button" data-bs-toggle="offcanvas"
              data-bs-target="#profilecanvasRight" aria-controls="profilecanvasRight">
              <img src="{{ asset('assets/images/avtar/woman.jpg') }}" alt="avtar" class="b-r-10 h-35 w-35">
            </a>

            <div class="offcanvas offcanvas-end header-profile-canvas" tabindex="-1" id="profilecanvasRight"
              aria-labelledby="profilecanvasRight">
              <div class="offcanvas-body app-scroll">
                <ul class="">
                  <li>
                    <div class="d-flex-center">
                      <span class="h-45 w-45 d-flex-center b-r-10 position-relative">
                        <img src="{{ asset('assets/images/avtar/woman.jpg') }}" alt="" class="img-fluid b-r-10">
                      </span>
                    </div>
                    <div class="text-center mt-2">
                      <h6 class="mb-0"> {{ auth()->user()->name }} </h6>
                      <p class="f-s-12 mb-0 text-secondary"> {{ auth()->user()->email }}</p>
                    </div>
                  </li>

                  <li class="app-divider-v dotted py-1"></li>
                  <li>
                    <a class="f-w-500" href="./profile.html" target="_blank">
                      <i class="ph-duotone  ph-user-circle pe-1 f-s-20"></i> Profile Details
                    </a>
                  </li>
                  <li>
                    <a class="f-w-500" href="./setting.html" target="_blank">
                      <i class="ph-duotone  ph-gear pe-1 f-s-20"></i> Settings
                    </a>
                  </li>
                  <li class="app-divider-v dotted py-1"></li>

                  <li>

                    <a class="mb-0 text-danger" href="{{ route('logout') }}">
                      <i class="ph-duotone  ph-sign-out pe-1 f-s-20"></i> Log Out
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</header>
<!-- Header Section ends -->