@extends('layout.main')
<!-- Body main section starts -->
@section('content')

<main>
    <div class="container-fluid">
        <!-- Breadcrumb start -->
        <div class="row m-1">
            <div class="col-12 ">
                <h4 class="main-title">Product Details</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li class="">
                        <a href="#" class="f-s-14 f-w-500">
                            <span>
                                <i class="ph-duotone  ph-stack f-s-16"></i> Apps
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="f-s-14 f-w-500">E-shop</a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">Product Details</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb end -->

        <!-- Product Details start -->
        <div class="row">
            <div class="col-md-6 col-xxl-3 order-md-2 order-xxl-1">
                <div class="card">
                    <div class="card-body">
                        <div class="slider product-slider-for mb-3">
                            <div class="slider-1">
                                <img src="../../assets/images/ecommerce/09.jpg" class="img-fluid rounded" alt="image">
                            </div>
                            <div class="slider-2">
                                <img src="../../assets/images/ecommerce/26.jpg" class="img-fluid rounded" alt="image">
                            </div>
                            <div class="slider-3">
                                <img src="../../assets/images/ecommerce/27.jpg" class="img-fluid rounded" alt="image">
                            </div>
                            <div class="slider-4">
                                <img src="../../assets/images/ecommerce/28.jpg" class="img-fluid rounded" alt="image">
                            </div>
                        </div>

                        <div class="slider product-slider-nav app-arrow">
                            <div class="slider-1">
                                <img src="../../assets/images/ecommerce/09.jpg" class="img-fluid rounded" alt="image">
                            </div>
                            <div class="slider-2">
                                <img src="../../assets/images/ecommerce/26.jpg" class="img-fluid rounded" alt="image">
                            </div>
                            <div class="slider-3">
                                <img src="../../assets/images/ecommerce/27.jpg" class="img-fluid rounded" alt="image">
                            </div>
                            <div class="slider-4">
                                <img src="../../assets/images/ecommerce/28.jpg" class="img-fluid rounded" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-6 order-xxl-2">
                <div class="card">
                    <div class="card-body">
                        <div class="product-details-contentbox">
                            <h4>Trendy &amp; Stylish For Men</h4>
                            <div class="mt-2 d-flex align-items-center gap-2">
                                <div class="rating ">
                                    <input type="radio" id="star11" name="ratings2" value="11" checked="" disabled="">
                                    <label class="star" for="star11"><span
                                            class="ti ti-star-filled f-s-20 text-warning"></span></label>
                                    <input type="radio" id="star15" name="ratings2" value="15" checked="" disabled="">
                                    <label class="star" for="star15"><span
                                            class="ti ti-star-filled f-s-20 text-warning"></span></label>
                                    <input type="radio" id="star12" name="ratings2" value="12" disabled="">
                                    <label class="star" for="star12"><span
                                            class="ti ti-star-half-filled text-warning f-s-20"></span></label>
                                    <input type="radio" id="star13" name="ratings2" value="13" disabled="">
                                    <label class="star" for="star13"><span
                                            class="ti ti-star f-s-20 text-warning"></span></label>
                                    <input type="radio" id="star14" name="ratings2" value="14" disabled="">
                                    <label class="star" for="star14"><span
                                            class="ti ti-star f-s-20 text-warning"></span></label>
                                </div>
                                <div>
                                    <h6 class="m-0 text-warning">(<span class="f-w-600">4.50k</span> Review )</h6>
                                </div>
                            </div>
                            <div class="mt-4 product-details">
                                <h3>$26.00 <span>(54% OFF)</span></h3>
                            </div>

                            <div class="app-divider-v dotted pb-2"></div>

                            <div class="product-detailbox mt-4">
                                <div>
                                    <h5>Diamond:</h5>
                                    <div class="form-selectgroup">
                                        <label class="select-items">
                                            <input type="checkbox" class="select-input" checked>
                                            <span class="select-box">
                                                <span class="selectitem">
                                                    6
                                                </span>
                                            </span>
                                        </label>
                                        <label class="select-items">
                                            <input type="checkbox" class="select-input">
                                            <span class="select-box">
                                                <span class="selectitem">
                                                    7
                                                </span>
                                            </span>
                                        </label>
                                        <label class="select-items">
                                            <input type="checkbox" class="select-input">
                                            <span class="select-box">
                                                <span class="selectitem">
                                                    25
                                                </span>
                                            </span>
                                        </label>
                                        <label class="select-items">
                                            <input type="checkbox" class="select-input">
                                            <span class="select-box">
                                                <span class="selectitem">
                                                    30
                                                </span>
                                            </span>
                                        </label>
                                        <label class="select-items">
                                            <input type="checkbox" class="select-input">
                                            <span class="select-box">
                                                <span class="selectitem">
                                                    40
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <h5>Total:</h5>
                                    <div class="form-selectgroup">
                                        <label class="select-items">
                                            <input type="checkbox" class="select-input" checked>
                                            <span class="select-box">
                                                <span class="selectitem">
                                                    6
                                                </span>
                                            </span>
                                        </label>
                                        <label class="select-items">
                                            <input type="checkbox" class="select-input">
                                            <span class="select-box">
                                                <span class="selectitem">
                                                    7
                                                </span>
                                            </span>
                                        </label>
                                        <label class="select-items">
                                            <input type="checkbox" class="select-input">
                                            <span class="select-box">
                                                <span class="selectitem">
                                                    25
                                                </span>
                                            </span>
                                        </label>
                                        <label class="select-items">
                                            <input type="checkbox" class="select-input">
                                            <span class="select-box">
                                                <span class="selectitem">
                                                    30
                                                </span>
                                            </span>
                                        </label>
                                        <label class="select-items">
                                            <input type="checkbox" class="select-input">
                                            <span class="select-box">
                                                <span class="selectitem">
                                                    40
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                </div>


                            </div>
                            <div class="product-detailbox mt-4">
                                <div>
                                    <h5>Payment:</h5>
                                    <div class="option-color-list check-container">
                                        <label class="check-box">
                                            <input type="radio" name="radio-group1" checked>
                                            <span class="radiomark check-primary ms-2"></span>
                                        </label>
                                        <label class="check-box">
                                            <input type="radio" name="radio-group1">
                                            <span class="radiomark check-secondary ms-2"></span>
                                        </label>
                                        <label class="check-box">
                                            <input type="radio" name="radio-group1">
                                            <span class="radiomark check-success ms-2"></span>
                                        </label>
                                        <label class="check-box">
                                            <input type="radio" name="radio-group1">
                                            <span class="radiomark check-danger ms-2"></span>
                                        </label>
                                        <label class="check-box">
                                            <input type="radio" name="radio-group1">
                                            <span class="radiomark check-warning ms-2"></span>
                                        </label>
                                        <label class="check-box">
                                            <input type="radio" name="radio-group1">
                                            <span class="radiomark check-info ms-2"></span>
                                        </label>
                                        <label class="check-box">
                                            <input type="radio" name="radio-group1">
                                            <span class="radiomark check-light ms-2"></span>
                                        </label>
                                        <label class="check-box">
                                            <input type="radio" name="radio-group1">
                                            <span class="radiomark check-dark ms-2"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>



                            <div class="product-details-btn text-end mt-4">
                                {{-- <a href="cart.html" role="button" class="btn btn-primary">Add To Cart</a> --}}
                                <a href="checkout.html" role="button" class="btn btn-success">Buy Now</a>
                                {{-- <a href="wishlist.html" role="button" class="btn btn-danger">Add to Wishlist</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xxl-3 order-md-1 order-xxl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="product-details-contentbox">
                            <div>
                                <ul class="offer-details-list">
                        <li>
                          <i class="ti ti-tags text-primary f-s-18 me-1"></i> <b class="text-secondary">Bank
                            Offer</b> 10% Instant
                          Discount on ICICI
                          Bank Credit Card, up to ₹1250 on orders of ₹5,000 and above
                        </li>
                        <li>
                          <i class="ti ti-tags text-primary f-s-18 me-1"></i> <b class="text-secondary">Bank
                            Offer</b>
                          Kotak Bank
                          Credit Card, up
                          to ₹1250 on orders of ₹5,000 and above
                        </li>
                      </ul>
                                <h5>Similar Products:</h5>
                                <div class="product-details-table">
                                    <table class="table table-bottom-border align-middle products-data-table">
                                        <tbody>
                                            <tr class="border-0">
                                                <td>
                                                    <div class="position-relative">
                                                        <img src="../../assets/images/dashboard/ecommerce-dashboard/16.png"
                                                            alt="product-image" class="w-45 h-45 position-absolute">
                                                        <div class="mg-s-40">
                                                            <h6 class="text-dark f-w-600 txt-ellipsis-1">Sports shoes
                                                            </h6>
                                                            <p class="text-secondary mb-0">#AB9875</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <h6 class="f-s-15 text-success">$450</h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="position-relative">
                                                        <img src="../../assets/images/dashboard/ecommerce-dashboard/01.png"
                                                            alt="product-image" class="w-45 h-45 position-absolute">
                                                        <div class="mg-s-40">
                                                            <h6 class="text-dark f-w-600 txt-ellipsis-1">Smartwatch</h6>
                                                            <p class="text-secondary mb-0">#AB8394</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <h6 class="f-s-15 text-success">$920</h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="position-relative">
                                                        <img src="../../assets/images/dashboard/ecommerce-dashboard/09.png"
                                                            alt="product-image" class="w-45 h-45 position-absolute">
                                                        <div class="mg-s-40">
                                                            <h6 class="text-dark f-w-600 txt-ellipsis-1">T-shirt</h6>
                                                            <p class="text-secondary mb-0">#AB3804</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <h6 class="f-s-15 text-success">$100</h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="position-relative">
                                                        <img src="../../assets/images/dashboard/ecommerce-dashboard/02.png"
                                                            alt="product-image" class="w-45 h-45 position-absolute">
                                                        <div class="mg-s-40">
                                                            <h6 class="text-dark f-w-600 txt-ellipsis-1">Airpods</h6>
                                                            <p class="text-secondary mb-0">#AB2903</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <h6 class="f-s-15 text-success">$10,900</h6>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a role="button" href="product.html" target="_blank"
                                        class="btn  btn-primary w-100">View All Products</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Details end -->
    </div>
</main>


{{-- <script src="{{ asset('assets/js/product_details.js') }}"></script> --}}
@endsection
