@extends('layout.main')
<!-- Body main section starts -->
@section('content')

    <style>
        .product-grid .product-image img {
            width: 100%;
            height: 300px;
            background-color: #000000;
            object-fit: cover;
            object-position: center center;
        }

        .cat-card:hover {
            border-radius: var(--app-border-radius);
            background-color: rgba(var(--dark), 1);
            cursor: pointer;
        }

        .cat-card:hover a {
            color: white;
        }

        .cat-active {
            border-radius: var(--app-border-radius);
            background-color: rgba(var(--dark), 1);
        }

        .cat-active a {
            color: rgba(var(--light), 1);
        }

        .ajax-loader {
            height: 100% !important;
            width: 100%;
            position: absolute;
            z-index: 999;
            backdrop-filter: blur(5px);
            align-items: center;
        }

        .ajax-loader .spinner-border {
            border-width: 8px;
            width: 50px;
            height: 50px;
        }
    </style>
    <!-- slick-file -->
    <script src="{{ asset('assets/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.js') }}"></script>

    <script src="{{ asset('assets/js/product_details.js') }}"></script>

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
                        <div class="card-body d-flex flex-column justify-content-center align-items-center cat-card cat-active"
                            data-category="favorite">
                            <a href="#">
                                <i class="ph ph-star fs-1 mb-2"></i>
                                <p class="mb-0">Populer</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-3">
                    <div class="card text-center h-100">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center cat-card"
                            data-category="1">
                            <a href="#">
                                <i class="ph ph-device-mobile-camera fs-1 mb-2"></i>
                                <p class="mb-0">Mobile Games</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-3">
                    <div class="card text-center h-100">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center cat-card"
                            data-category="2">
                            <a href="#">
                                <i class="ph ph-monitor fs-1 mb-2"></i>
                                <p class="mb-0">Pc Games</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-3">
                    <div class="card text-center h-100">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center cat-card"
                            data-category="other">
                            <a href="#">
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
                <input type="hidden" id="categoryProduct" value="favorite">
                <div class="col-12">

                    <div class="row product-list-row" style="position: relative">
                        <div class="d-flex justify-content-center ajax-loader d-none">
                            <div class="spinner-border spinner-border-lg text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script src="{{ asset('assets/js/slick.js') }}"></script>

    <script>
        $(document).ready(function () {
            get_product();
        });

        function get_product() {


            let dataPost = {
                "_token": "{{ csrf_token() }}",
                "limit": 12,
                "category": $(`#categoryProduct`).val()
            }


            $.ajax({
                url: '/customer_get_product',
                type: 'POST',
                data: dataPost,
                dataType: 'json',
                beforeSend: function () {

                    $('.ajax-loader').removeClass('d-none');

                },

                success: function (response) {
                    $('.ajax-loader').addClass('d-none');
                    $('.product-row').remove();
                    $('.not-found').remove();
                    var products = response.products;
                    // var userList = $('#userList');
                    // userList.empty();
                    let isImage = false;
                    let imgPath;

                    if (products.length < 1) {
                        $(`.product-list-row`).append(`
                                           <div class="text-center col-12 not-found">
                                                <img src="{{ asset('assets/images/icons/notfound.png') }}" class="img-fluid rounded" style="width:35%"
                                            alt="image">
                                                <h3 class="">Produk Tidak Ditemukan</h3>
                                          </div>
                                        `)

                        $(".notfound img").on("load", function (event) {
                            $(".notfound").append('<h3 class="">Produk Tidak Ditemukan</h3>')
                        })

                        return;
                    }

                    products.forEach(function (product) {
                        imgPath = "{{ asset('assets/images/icons/joystick.jpg')}}";
                        if (product.product_pic != null) imgPath = `{{ asset('uploads/product/${product.product_pic}')}}`;

                        $(`.product-list-row`).append(`
                                        <div class="col-lg-3 col-md-4 col-sm-6 product-row">
                                           <div class="card overflow-hidden">
                                               <div class="card-body p-0">
                                                   <div class="product-content-box">
                                                       <div class="product-grid">
                                                           <div class="product-image">
                                                               <a href="/customer_product_detail/${product.id}" class="image">
                                                                   <img class="pic-1" src="${imgPath}" alt="">
                                                                   <img class="images_box" src="${imgPath}"
                                                                       alt="">
                                                               </a>
                                                               <ul class="product-links">
                                                            
                                                                   <li><a href="/customer_product_detail/${product.id}"
                                                                           class="bg-success h-30 w-30 d-flex-center b-r-20"><i
                                                                               class="ti ti-eye f-s-18 text-light"></i></a></li>
                                                               </ul>
                                                           </div>
                                                       </div>
                                                       <div class="p-3">
                                                           <div class="d-flex justify-content-between align-items-center">
                                                               <a href="/customer_product_detail/${product.id}" class="m-0 f-s-18 f-w-500">${product.name.slice(0, 17) + (product.name.length > 17 ? "..." : "")}</a>
                                                                <span class="badge text-bg-info text-white b-r-10">${product.category_name}</span>
                                                           </div>
                                                           <p class="text-secondary">${product.game}</p>
                                                           <div class="pricing-box">
                                                               <h6>Rp. ${formatIdr(product.product_price)}</h6>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>

                                       </div>

                        `);
                    });

                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });

        }

        var formatIdr = function (num) {
            var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
            if (str.indexOf(".") > 0) {
                parts = str.split(".");
                str = parts[0];
            }
            str = str.split("").reverse();
            for (var j = 0, len = str.length; j < len; j++) {
                if (str[j] != ",") {
                    output.push(str[j]);
                    if (i % 3 == 0 && j < (len - 1)) {
                        output.push(".");
                    }
                    i++;
                }
            }
            formatted = output.reverse().join("");
            return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
        };

        $('.cat-card').on('click', function (ele) {
            event.preventDefault();
            if ($(this).data('category') == "other") {
                window.location.href = `{{ route('customer_product_list') }}`;
                return false;
            }

            $('.cat-card').removeClass('cat-active');
            $(this).addClass('cat-active');
            $('#categoryProduct').val($(this).data('category'));
            get_product();
        });
    </script>
@endsection