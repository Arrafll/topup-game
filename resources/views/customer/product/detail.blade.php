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
                        <a href="{{ route('customer.home') }}" class="f-s-14 f-w-500">
                            <span>
                                <i class="ph-duotone  ph-stack f-s-16"></i> Beranda
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.products') }}" class="f-s-14 f-w-500">Games</a>
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


                            <div class="product-detailbox mt-4 row">
                                <div class="col-sm-9">
                                    <h5>Diamond:</h5>
                                    <div class="form-selectgroup">
                                        <label class="select-items">
                                            <input type="radio" class="select-input" name="diamond" checked>
                                            <span class="select-box">
                                                <span class="selectitem">
                                                    <h5>60</h5>
                                                    Rp.30.000
                                                </span>
                                            </span>
                                        </label>
                                        <label class="select-items">
                                            <input type="radio" class="select-input" name="diamond">
                                            <span class="select-box">
                                                <span class="selectitem">
                                                    <h5>120</h5>
                                                    Rp.60.000
                                                </span>
                                            </span>
                                        </label>
                                        <label class="select-items">
                                            <input type="radio" class="select-input" name="diamond">
                                            <span class="select-box">
                                                <span class="selectitem">
                                                    <h5>250</h5>
                                                    Rp.125.000
                                                </span>
                                            </span>
                                        </label>
                                        <label class="select-items">
                                            <input type="radio" class="select-input" name="diamond">
                                            <span class="select-box">
                                                <span class="selectitem">
                                                    <h5>500</h5>
                                                    Rp.250.000
                                                </span>
                                            </span>
                                        </label>
                                        <!-- Tambahkan lebih banyak pilihan jika diperlukan -->
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Total:</h5>
                                    <div class="mt-2">
                                        <input type="number" class="form-control" name="total" min="1"
                                            >
                                    </div>
                                </div>
                            </div>
                            <div class="product-detailbox mt-4 row">
                                <div class="col-sm-9">
                                    <h5>Payment:</h5>
                                    <div class="form-selectgroup">
                                        <label class="select-items">
                                            <input type="radio" class="select-input" name="diamond" checked>
                                            <span class="select-box">
                                                <span class="selectitem">
                                                    <h5><i class="ph ph-paypal-logo"></i> Paypal</h5>
                                                    Rp.30.000
                                                </span>
                                            </span>
                                        </label>
                                        <label class="select-items">
                                            <input type="radio" class="select-input" name="diamond" checked>
                                            <span class="select-box">
                                                <span class="selectitem">
                                                    <h5><i class="ph ph-paypal-logo"></i> Paypal</h5>
                                                    Rp.30.000
                                                </span>
                                            </span>
                                        </label>
                                        <label class="select-items">
                                            <input type="radio" class="select-input" name="diamond" checked>
                                            <span class="select-box">
                                                <span class="selectitem">
                                                    <h5><i class="ph ph-paypal-logo"></i> Paypal</h5>
                                                    Rp.30.000
                                                </span>
                                            </span>
                                        </label>
                                        <!-- Tambahkan lebih banyak pilihan jika diperlukan -->
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Game ID:</h5>
                                    <div class="mt-2">
                                        <input type="text" class="form-control" name="total"
                                            >
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
                                        <i class="ti ti-tags text-primary f-s-18 me-1"></i> <b
                                            class="text-secondary">Bank
                                            Offer</b> 10% Instant
                                        Discount on ICICI
                                        Bank Credit Card, up to ₹1250 on orders of ₹5,000 and above
                                    </li>
                                    <li>
                                        <i class="ti ti-tags text-primary f-s-18 me-1"></i> <b
                                            class="text-secondary">Bank
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
