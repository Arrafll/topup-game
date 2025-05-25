@extends('layout.main')
<!-- Body main section starts -->
@section('content')

<script>
    // 7 autoplay-slider
    $('.autoplay-slider').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2
                }
            },
        ]
    });

</script>

<main>
    <div class="container-fluids">
        <!-- Breadcrumb start -->
        <div class="row m-1">
            <div class="col-12 ">
                <h4 class="main-title">Beranda</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li class="">
                        <a href="#" class="f-s-14 f-w-500">
                            <span>
                                <i class="ph-duotone	ph-stack f-s-16"></i> Beranda
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb end -->

        {{-- banner --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="autoplay-slider app-arrow">
                            <div class="autoplay-item">
                                <img src="..\assets\images\kliktopup\banner1.jpg" class="img-fluid rounded" alt="image">
                            </div>
                            <div class="autoplay-item">
                                <img src="..\assets\images\kliktopup\banner2.jpg" class="img-fluid rounded" alt="image">
                            </div>
                            {{-- <div class="autoplay-item">
                                <img src="..\assets\images\kliktopup\image.png" class="img-fluid rounded" alt="image">
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- banner --}}

        {{-- category --}}
        <div class="row g-3">

            <div class="col-6 col-sm-4 col-md-3">
                <div class="card text-center h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <a href="{{ route('customer.products') }}">
                            <i class="ph ph-star fs-1 mb-2"></i>
                            <p class="mb-0">Populer</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3">
                <div class="card text-center h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <a href="{{ route('customer.products') }}">
                            <i class="ph ph-device-mobile-camera fs-1 mb-2"></i>
                            <p class="mb-0">Mobile Games</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3">
                <div class="card text-center h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <a href="{{ route('customer.products') }}">
                            <i class="ph ph-monitor fs-1 mb-2"></i>
                            <p class="mb-0">Pc Games</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3">
                <div class="card text-center h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <a href="{{ route('customer.products') }}">
                            <i class="ph-bold  ph-list-bullets fs-1 mb-2"></i>
                            <p class="mb-0">Lainnya</p>
                        </a>
                    </div>
                </div>
            </div>



        </div>
        {{-- category --}}

        {{-- Shop --}}
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-xxl-2 col-md-4 col-sm-6">
                        <div class="card overflow-hidden">
                            <div class="card-body p-0">
                                <div class="product-content-box">
                                    <div class="product-grid">
                                        <div class="product-image">
                                            <a href="#" class="image">
                                                <img class="pic-1" src="../assets/images/ecommerce/09.jpg" alt="">
                                                <img class="images_box" src="../assets/images/ecommerce/10.jpg" alt="">
                                            </a>
                                            <ul class="product-links">
                                                <li><a href="wishlist.html"
                                                        class="bg-danger h-30 w-30 d-flex-center b-r-20"><i
                                                            class="f-s-18 ti ti-heart text-light"></i></a></li>
                                                <li><a href="cart.html"
                                                        class="bg-primary h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-shopping-cart f-s-18 text-light"></i></a>
                                                </li>
                                                <li><a href="product_details.html"
                                                        class="bg-success h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-eye f-s-18 text-light"></i></a></li>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="p-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="product_details.html" class="m-0 f-s-20 f-w-500">Sandals</a>
                                            <p class="text-warning m-0">4.2 <span class="text-warning"><i
                                                        class="ti ti-star-filled"></i></span></p>
                                        </div>
                                        <p class="text-secondary">Stylist Sandals for women</p>
                                        <div class="pricing-box">
                                            <h6>$390 <span>(<del>$400</del>)</span><span class="text-success ms-2">12%
                                                    off</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6">
                        <div class="card overflow-hidden">
                            <div class="card-body p-0">
                                <div class="product-content-box">
                                    <div class="product-grid">
                                        <div class="product-image">
                                            <a href="#" class="image">
                                                <img class="pic-1" src="../assets/images/ecommerce/09.jpg" alt="">
                                                <img class="images_box" src="../assets/images/ecommerce/10.jpg" alt="">
                                            </a>
                                            <ul class="product-links">
                                                <li><a href="wishlist.html"
                                                        class="bg-danger h-30 w-30 d-flex-center b-r-20"><i
                                                            class="f-s-18 ti ti-heart text-light"></i></a></li>
                                                <li><a href="cart.html"
                                                        class="bg-primary h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-shopping-cart f-s-18 text-light"></i></a>
                                                </li>
                                                <li><a href="product_details.html"
                                                        class="bg-success h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-eye f-s-18 text-light"></i></a></li>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="p-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="product_details.html" class="m-0 f-s-20 f-w-500">Sandals</a>
                                            <p class="text-warning m-0">4.2 <span class="text-warning"><i
                                                        class="ti ti-star-filled"></i></span></p>
                                        </div>
                                        <p class="text-secondary">Stylist Sandals for women</p>
                                        <div class="pricing-box">
                                            <h6>$390 <span>(<del>$400</del>)</span><span class="text-success ms-2">12%
                                                    off</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6">
                        <div class="card overflow-hidden">
                            <div class="card-body p-0">
                                <div class="product-content-box">
                                    <div class="product-grid">
                                        <div class="product-image">
                                            <a href="#" class="image">
                                                <img class="pic-1" src="../assets/images/ecommerce/09.jpg" alt="">
                                                <img class="images_box" src="../assets/images/ecommerce/10.jpg" alt="">
                                            </a>
                                            <ul class="product-links">
                                                <li><a href="wishlist.html"
                                                        class="bg-danger h-30 w-30 d-flex-center b-r-20"><i
                                                            class="f-s-18 ti ti-heart text-light"></i></a></li>
                                                <li><a href="cart.html"
                                                        class="bg-primary h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-shopping-cart f-s-18 text-light"></i></a>
                                                </li>
                                                <li><a href="product_details.html"
                                                        class="bg-success h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-eye f-s-18 text-light"></i></a></li>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="p-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="product_details.html" class="m-0 f-s-20 f-w-500">Sandals</a>
                                            <p class="text-warning m-0">4.2 <span class="text-warning"><i
                                                        class="ti ti-star-filled"></i></span></p>
                                        </div>
                                        <p class="text-secondary">Stylist Sandals for women</p>
                                        <div class="pricing-box">
                                            <h6>$390 <span>(<del>$400</del>)</span><span class="text-success ms-2">12%
                                                    off</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6">
                        <div class="card overflow-hidden">
                            <div class="card-body p-0">
                                <div class="product-content-box">
                                    <div class="product-grid">
                                        <div class="product-image">
                                            <a href="#" class="image">
                                                <img class="pic-1" src="../assets/images/ecommerce/09.jpg" alt="">
                                                <img class="images_box" src="../assets/images/ecommerce/10.jpg" alt="">
                                            </a>
                                            <ul class="product-links">
                                                <li><a href="wishlist.html"
                                                        class="bg-danger h-30 w-30 d-flex-center b-r-20"><i
                                                            class="f-s-18 ti ti-heart text-light"></i></a></li>
                                                <li><a href="cart.html"
                                                        class="bg-primary h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-shopping-cart f-s-18 text-light"></i></a>
                                                </li>
                                                <li><a href="product_details.html"
                                                        class="bg-success h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-eye f-s-18 text-light"></i></a></li>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="p-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="product_details.html" class="m-0 f-s-20 f-w-500">Sandals</a>
                                            <p class="text-warning m-0">4.2 <span class="text-warning"><i
                                                        class="ti ti-star-filled"></i></span></p>
                                        </div>
                                        <p class="text-secondary">Stylist Sandals for women</p>
                                        <div class="pricing-box">
                                            <h6>$390 <span>(<del>$400</del>)</span><span class="text-success ms-2">12%
                                                    off</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6">
                        <div class="card overflow-hidden">
                            <div class="card-body p-0">
                                <div class="product-content-box">
                                    <div class="product-grid">
                                        <div class="product-image">
                                            <a href="#" class="image">
                                                <img class="pic-1" src="../assets/images/ecommerce/09.jpg" alt="">
                                                <img class="images_box" src="../assets/images/ecommerce/10.jpg" alt="">
                                            </a>
                                            <ul class="product-links">
                                                <li><a href="wishlist.html"
                                                        class="bg-danger h-30 w-30 d-flex-center b-r-20"><i
                                                            class="f-s-18 ti ti-heart text-light"></i></a></li>
                                                <li><a href="cart.html"
                                                        class="bg-primary h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-shopping-cart f-s-18 text-light"></i></a>
                                                </li>
                                                <li><a href="product_details.html"
                                                        class="bg-success h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-eye f-s-18 text-light"></i></a></li>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="p-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="product_details.html" class="m-0 f-s-20 f-w-500">Sandals</a>
                                            <p class="text-warning m-0">4.2 <span class="text-warning"><i
                                                        class="ti ti-star-filled"></i></span></p>
                                        </div>
                                        <p class="text-secondary">Stylist Sandals for women</p>
                                        <div class="pricing-box">
                                            <h6>$390 <span>(<del>$400</del>)</span><span class="text-success ms-2">12%
                                                    off</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6">
                        <div class="card overflow-hidden">
                            <div class="card-body p-0">
                                <div class="product-content-box">
                                    <div class="product-grid">
                                        <div class="product-image">
                                            <a href="#" class="image">
                                                <img class="pic-1" src="../assets/images/ecommerce/09.jpg" alt="">
                                                <img class="images_box" src="../assets/images/ecommerce/10.jpg" alt="">
                                            </a>
                                            <ul class="product-links">
                                                <li><a href="wishlist.html"
                                                        class="bg-danger h-30 w-30 d-flex-center b-r-20"><i
                                                            class="f-s-18 ti ti-heart text-light"></i></a></li>
                                                <li><a href="cart.html"
                                                        class="bg-primary h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-shopping-cart f-s-18 text-light"></i></a>
                                                </li>
                                                <li><a href="product_details.html"
                                                        class="bg-success h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-eye f-s-18 text-light"></i></a></li>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="p-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="product_details.html" class="m-0 f-s-20 f-w-500">Sandals</a>
                                            <p class="text-warning m-0">4.2 <span class="text-warning"><i
                                                        class="ti ti-star-filled"></i></span></p>
                                        </div>
                                        <p class="text-secondary">Stylist Sandals for women</p>
                                        <div class="pricing-box">
                                            <h6>$390 <span>(<del>$400</del>)</span><span class="text-success ms-2">12%
                                                    off</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6">
                        <div class="card overflow-hidden">
                            <div class="card-body p-0">
                                <div class="product-content-box">
                                    <div class="product-grid">
                                        <div class="product-image">
                                            <a href="#" class="image">
                                                <img class="pic-1" src="../assets/images/ecommerce/09.jpg" alt="">
                                                <img class="images_box" src="../assets/images/ecommerce/10.jpg" alt="">
                                            </a>
                                            <ul class="product-links">
                                                <li><a href="wishlist.html"
                                                        class="bg-danger h-30 w-30 d-flex-center b-r-20"><i
                                                            class="f-s-18 ti ti-heart text-light"></i></a></li>
                                                <li><a href="cart.html"
                                                        class="bg-primary h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-shopping-cart f-s-18 text-light"></i></a>
                                                </li>
                                                <li><a href="product_details.html"
                                                        class="bg-success h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-eye f-s-18 text-light"></i></a></li>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="p-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="product_details.html" class="m-0 f-s-20 f-w-500">Sandals</a>
                                            <p class="text-warning m-0">4.2 <span class="text-warning"><i
                                                        class="ti ti-star-filled"></i></span></p>
                                        </div>
                                        <p class="text-secondary">Stylist Sandals for women</p>
                                        <div class="pricing-box">
                                            <h6>$390 <span>(<del>$400</del>)</span><span class="text-success ms-2">12%
                                                    off</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6">
                        <div class="card overflow-hidden">
                            <div class="card-body p-0">
                                <div class="product-content-box">
                                    <div class="product-grid">
                                        <div class="product-image">
                                            <a href="#" class="image">
                                                <img class="pic-1" src="../assets/images/ecommerce/09.jpg" alt="">
                                                <img class="images_box" src="../assets/images/ecommerce/10.jpg" alt="">
                                            </a>
                                            <ul class="product-links">
                                                <li><a href="wishlist.html"
                                                        class="bg-danger h-30 w-30 d-flex-center b-r-20"><i
                                                            class="f-s-18 ti ti-heart text-light"></i></a></li>
                                                <li><a href="cart.html"
                                                        class="bg-primary h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-shopping-cart f-s-18 text-light"></i></a>
                                                </li>
                                                <li><a href="product_details.html"
                                                        class="bg-success h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-eye f-s-18 text-light"></i></a></li>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="p-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="product_details.html" class="m-0 f-s-20 f-w-500">Sandals</a>
                                            <p class="text-warning m-0">4.2 <span class="text-warning"><i
                                                        class="ti ti-star-filled"></i></span></p>
                                        </div>
                                        <p class="text-secondary">Stylist Sandals for women</p>
                                        <div class="pricing-box">
                                            <h6>$390 <span>(<del>$400</del>)</span><span class="text-success ms-2">12%
                                                    off</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6">
                        <div class="card overflow-hidden">
                            <div class="card-body p-0">
                                <div class="product-content-box">
                                    <div class="product-grid">
                                        <div class="product-image">
                                            <a href="#" class="image">
                                                <img class="pic-1" src="../assets/images/ecommerce/09.jpg" alt="">
                                                <img class="images_box" src="../assets/images/ecommerce/10.jpg" alt="">
                                            </a>
                                            <ul class="product-links">
                                                <li><a href="wishlist.html"
                                                        class="bg-danger h-30 w-30 d-flex-center b-r-20"><i
                                                            class="f-s-18 ti ti-heart text-light"></i></a></li>
                                                <li><a href="cart.html"
                                                        class="bg-primary h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-shopping-cart f-s-18 text-light"></i></a>
                                                </li>
                                                <li><a href="product_details.html"
                                                        class="bg-success h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-eye f-s-18 text-light"></i></a></li>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="p-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="product_details.html" class="m-0 f-s-20 f-w-500">Sandals</a>
                                            <p class="text-warning m-0">4.2 <span class="text-warning"><i
                                                        class="ti ti-star-filled"></i></span></p>
                                        </div>
                                        <p class="text-secondary">Stylist Sandals for women</p>
                                        <div class="pricing-box">
                                            <h6>$390 <span>(<del>$400</del>)</span><span class="text-success ms-2">12%
                                                    off</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6">
                        <div class="card overflow-hidden">
                            <div class="card-body p-0">
                                <div class="product-content-box">
                                    <div class="product-grid">
                                        <div class="product-image">
                                            <a href="#" class="image">
                                                <img class="pic-1" src="../assets/images/ecommerce/09.jpg" alt="">
                                                <img class="images_box" src="../assets/images/ecommerce/10.jpg" alt="">
                                            </a>
                                            <ul class="product-links">
                                                <li><a href="wishlist.html"
                                                        class="bg-danger h-30 w-30 d-flex-center b-r-20"><i
                                                            class="f-s-18 ti ti-heart text-light"></i></a></li>
                                                <li><a href="cart.html"
                                                        class="bg-primary h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-shopping-cart f-s-18 text-light"></i></a>
                                                </li>
                                                <li><a href="product_details.html"
                                                        class="bg-success h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-eye f-s-18 text-light"></i></a></li>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="p-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="product_details.html" class="m-0 f-s-20 f-w-500">Sandals</a>
                                            <p class="text-warning m-0">4.2 <span class="text-warning"><i
                                                        class="ti ti-star-filled"></i></span></p>
                                        </div>
                                        <p class="text-secondary">Stylist Sandals for women</p>
                                        <div class="pricing-box">
                                            <h6>$390 <span>(<del>$400</del>)</span><span class="text-success ms-2">12%
                                                    off</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6">
                        <div class="card overflow-hidden">
                            <div class="card-body p-0">
                                <div class="product-content-box">
                                    <div class="product-grid">
                                        <div class="product-image">
                                            <a href="#" class="image">
                                                <img class="pic-1" src="../assets/images/ecommerce/09.jpg" alt="">
                                                <img class="images_box" src="../assets/images/ecommerce/10.jpg" alt="">
                                            </a>
                                            <ul class="product-links">
                                                <li><a href="wishlist.html"
                                                        class="bg-danger h-30 w-30 d-flex-center b-r-20"><i
                                                            class="f-s-18 ti ti-heart text-light"></i></a></li>
                                                <li><a href="cart.html"
                                                        class="bg-primary h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-shopping-cart f-s-18 text-light"></i></a>
                                                </li>
                                                <li><a href="product_details.html"
                                                        class="bg-success h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-eye f-s-18 text-light"></i></a></li>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="p-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="product_details.html" class="m-0 f-s-20 f-w-500">Sandals</a>
                                            <p class="text-warning m-0">4.2 <span class="text-warning"><i
                                                        class="ti ti-star-filled"></i></span></p>
                                        </div>
                                        <p class="text-secondary">Stylist Sandals for women</p>
                                        <div class="pricing-box">
                                            <h6>$390 <span>(<del>$400</del>)</span><span class="text-success ms-2">12%
                                                    off</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6">
                        <div class="card overflow-hidden">
                            <div class="card-body p-0">
                                <div class="product-content-box">
                                    <div class="product-grid">
                                        <div class="product-image">
                                            <a href="#" class="image">
                                                <img class="pic-1" src="../assets/images/ecommerce/09.jpg" alt="">
                                                <img class="images_box" src="../assets/images/ecommerce/10.jpg" alt="">
                                            </a>
                                            <ul class="product-links">
                                                <li><a href="wishlist.html"
                                                        class="bg-danger h-30 w-30 d-flex-center b-r-20"><i
                                                            class="f-s-18 ti ti-heart text-light"></i></a></li>
                                                <li><a href="cart.html"
                                                        class="bg-primary h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-shopping-cart f-s-18 text-light"></i></a>
                                                </li>
                                                <li><a href="product_details.html"
                                                        class="bg-success h-30 w-30 d-flex-center b-r-20"><i
                                                            class="ti ti-eye f-s-18 text-light"></i></a></li>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="p-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="product_details.html" class="m-0 f-s-20 f-w-500">Sandals</a>
                                            <p class="text-warning m-0">4.2 <span class="text-warning"><i
                                                        class="ti ti-star-filled"></i></span></p>
                                        </div>
                                        <p class="text-secondary">Stylist Sandals for women</p>
                                        <div class="pricing-box">
                                            <h6>$390 <span>(<del>$400</del>)</span><span class="text-success ms-2">12%
                                                    off</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<script src="{{ asset('assets/js/slick.js') }}"></script>
@endsection
