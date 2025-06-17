@extends('layout.main')
<!-- Body main section starts -->
@section('content')
    <style>
        .product-grid .product-image img {
            width: 100%;
            height: 250px;
            background-color: #000000;
            object-fit: cover;
            object-position: center center;
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
    <main>
        <div class="container-fluid">
            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 ">
                    <h4 class="main-title">Games</h4>
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
                            <a href="#" class="f-s-14 f-w-500">Product</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Breadcrumb end -->

            <!-- Product start -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="product-header d-flex jstify-content-between gap-3 align-items-center">
                                <div class="d-flex align-items-center">
                                    <a class="me-3 toggle-btn d-inline-block d-lg-none" role="button"><i
                                            class="ti ti-align-justified f-s-24"></i></a>
                                    <form class="app-form app-icon-form d-inline-block " action="#">
                                        <input type="hidden" name="" id="offsetProduct" value="0">
                                        <input type="hidden" name="" id="totalProduct" value="0">
                                        <div class="position-relative">
                                            <input type="search" class="form-control" placeholder="Search..."
                                                aria-label="Search" id="searchProduct">
                                            <i class="ti ti-search text-dark"></i>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters start -->
                <div class="col-xxl-3 col-lg-4 product-box productbox">
                    <div class="card">
                        <div class="card-header code-header">
                            <h5>Filters</h5>
                        </div>

                        <span class="accordion-button bg-none p-1">
                            <span class="m-0 mt-1">Sort By</span>
                        </span>
                        <div class="card-body ">
                            <ul class="list-group d-flex flex-column">

                                <li class="radio-wrapper ">
                                    <label class="check-box">
                                        <input type="radio" name="orderProducts" value="created_at-desc">
                                        <span class="radiomark outline-secondary"></span>
                                        <span class="text-secondary me-1">Terbaru</span>
                                    </label>
                                </li>

                                <li class="radio-wrapper ">
                                    <label class="check-box">
                                        <input type="radio" name="orderProducts" id="filterSort" value="created_at-asc">
                                        <span class="radiomark outline-secondary"></span>
                                        <span class="text-secondary me-1">Terlama</span>
                                    </label>
                                </li>

                                <li class="radio-wrapper ">
                                    <label class="check-box">
                                        <input type="radio" name="orderProducts" value="product_price-asc">
                                        <span class="radiomark outline-secondary"></span>
                                        <span class="text-secondary me-1">Harga : Rendah ke Tinggi</span>
                                    </label>
                                </li>

                                <li class="radio-wrapper ">
                                    <label class="check-box">
                                        <input type="radio" name="orderProducts" value="product_price-desc">
                                        <span class="radiomark outline-secondary"></span>
                                        <span class="text-secondary me-1">Harga : Tinggi ke Rendah</span>
                                    </label>
                                </li>

                            </ul>
                        </div>

                        <div style="border-bottom: var(--bs-card-border-width) solid var(--bs-card-border-color);background-color: transparent;
                                                border-color: var(--border_color);"></div>
                        <span class="accordion-button bg-none p-1">
                            <span class="m-0 mt-1">Category</span>
                        </span>
                        <div class="card-body">
                            <ul class="list-group d-flex flex-column">
                                @foreach ($categories as $ct)
                                    <li class="check-box">
                                        <label class="check-box">
                                            <input type="checkbox" class="category-checkbox" name="radio-group1"
                                                value="{{ $ct->id }}">
                                            <span class="checkmark outline-secondary"></span>
                                            <span class="text-secondary me-1">{{ $ct->name }}</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <div class="text-end m-3">
                                <button href="#" type="reset" role="button" class="btn btn-sm btn-secondary">Clear
                                    all</button>
                                <a href="#" role="button" class="btn btn-sm btn-primary"
                                    onclick="get_product(true)">Apply</a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Filters end -->

                <!-- product box start -->
                <div class="col-xxl-9 col-lg-8" style="position:relative">
                    <div class="product-wrapper-grid">
                        <div class="row product-list-row">
                            <div class="d-flex justify-content-center ajax-loader d-none">
                                <div class="spinner-border spinner-border-lg text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <!-- Product box -->


                            <!-- Product box -->
                        </div>
                    </div>

                </div>
                <!-- product box end -->
            </div>
            <!-- Product end -->
        </div>
    </main>
    <script>
        $(document).ready(function () {
            get_product();
        });

        function get_product(filter = false) {

            let isLoadMore = true;
            if (filter) isLoadMore = false;
            let categoryArr = [];
            let offsetProduct = $(`#offsetProduct`).val();
            $('.category-checkbox:checked').each(function () {
                categoryArr.push($(this).val());
            })

            let orderProducts = $('input[name="orderProducts"]:checked').val();
            let productSearch = $(`#searchProduct`).val();

            if (!isLoadMore) {
                $(`#offsetProduct`).val(0);
                offsetProduct = 0;
            }

            let dataPost = {
                "_token": "{{ csrf_token() }}",
                "limit": 8,
                "offset": offsetProduct,
                "search" : productSearch,
                "categories": JSON.stringify(categoryArr),
                "orders": orderProducts
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
                    $('.not-found').remove();
                    $('.load-more-btn').remove();


                    if (!isLoadMore) {
                        $('.product-row').remove();
                    }

                    var products = response.products;
                    var totalProducts = response.productsCount;
                    $(`#totalProduct`).val(totalProducts);
                    // var userList = $('#userList');
                    // userList.empty();
                    let isImage = false;
                    let imgPath;

                    if (products.length < 1) {
                        $(`.product-list-row`).append(`
                                            <div class="text-center col-12 not-found">
                                                <img src="{{ asset('assets/images/icons/notfound.png') }}" class="img-fluid rounded" style="width:35%"
                                                 alt="image">
                                                <h3 class="text-secondary">Produk Tidak Ditemukan</h3>
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
                                                           <a href="/customer_product_detail/${product.id}" class="m-0 f-s-16 f-w-500">${product.name.slice(0, 11) + (product.name.length > 13 ? "..." : "")}</a>
                                                            <span class="badge text-bg-info text-white b-r-10 f-s-10">${product.category_name}</span>
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

                    let offset = parseInt($(`#offsetProduct`).val());
                    let dataCount = parseInt($(`#totalProduct`).val());
                    let dataLeft = dataCount - (offset + 8);
                    console.log(dataLeft);
                    if (dataLeft > 0) {
                        offsetProduct = offset + 8
                        $(`#offsetProduct`).val(offsetProduct);
                    }

                    if (dataLeft > 0) {
                        $(`.product-list-row`).append(`
                                        <div class='col-12 load-more-btn'>
                                            <button type="button" class="btn btn-light-dark col-12" onclick="loadMore()">Load More</button>
                                        </div>
                                    `);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });

        }

        function loadMore() {
            get_product(false);
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


        document.querySelector('.toggle-btn').addEventListener('click', () => {
            var productbox = document.querySelector(".productbox");
            productbox.classList.toggle("producttoggle");
        });

    </script>
    <!-- Body main section ends -->
@endsection