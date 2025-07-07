@extends('layout.main')
<!-- Body main section starts -->
@section('content')
    <!-- toastify css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/toastify/toastify.css') }}">
    <style>
        .form-selects .card {
            border: 1px solid var(--border_color);
            border-radius: var(--bs-border-radius);
            cursor: pointer;
        }

        .form-selects .card .select-input {
            position: absolute;
            top: 0;
            left: 0;
            visibility: hidden;
        }

        .form-selects .card:has(.select-input:checked) {
            border: 1px solid rgb(var(--primary), 1);
            color: rgb(var(--primary), 1);
        }


        .form-selects .card:has(.select-input:disabled) {
            border: 1px solid var(--border_color);
        }

        .product-slider-nav img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .product-slider-for img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
    </style>

    <main>
        <div class="container-fluid">
            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 ">
                    <h4 class="main-title">Product Details</h4>
                    <ul class="app-line-breadcrumbs mb-3">
                        <li class="">
                            <a href="{{ route('customer') }}" class="f-s-14 f-w-500">
                                <span>
                                    KlikTopup
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customer_product_list') }}" class="f-s-14 f-w-500">Games</a>
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
                                @foreach ($attachments as $at)
                                    <div class="img-detail-container">
                                        <img src="{{ asset('uploads/product/' . $at->name) }}" class="img-fluid rounded"
                                            style="width:100%" alt="image">
                                    </div>
                                @endforeach
                            </div>
                            @if (count($attachments) > 1)
                                <div class="slider product-slider-nav app-arrow">
                                    @foreach ($attachments as $at)
                                        <div class="img-detail-container">
                                            <img src="{{ asset('uploads/product/' . $at->name) }}" class="img-fluid rounded"
                                                style="width:100%" alt="image">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-xxl-6 order-xxl-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="product-details-contentbox">
                                <h3>{{ $product->name }}</h3>

                                <div class="mt-2 product-details">
                                    <h5>
                                        {{ $product->game }}
                                    </h5>
                                </div>

                                <div class="app-divider-v dotted pb-2"></div>
                                <div class="product-detailbox row">

                                    <input type="hidden" value="{{ $product->id }}" id="productId">
                                    <div class="col-sm-12 mt-1 mb-1">
                                        @if ($product->is_voucher == 1)
                                            <p class="text-primary">Produk terdapat voucher yang akan dikirim ketika pesanan
                                                selesai.</p>
                                        @else
                                            <p class="text-primary">Produk ini tanpa voucher, currency akan dikirimkan ke Game
                                                ID di dalam game.</p>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <h5>Game ID</h5>
                                        <div class="mt-2">
                                            <input type="text" class="form-control" name="total"
                                                placeholder="Masukkan ID Game" id="gameId">
                                        </div>
                                    </div>
                                </div>
                                <h5 class="mt-4">Deskripsi</h5>
                                <div class="col-sm-12 mt-2 row ">
                                    <p>{{ $product->description }} </p>
                                </div>

                                <h5 class="mt-4">Paket {{ $product->unit }}</h5>
                                <div class="col-sm-12 mt-2 row form-selects">
                                    @foreach ($packages as $p)

                                        <div class="col-sm-4">
                                            <div class="card hover-effect select-package">
                                                @if ($product->is_voucher == 1 && $p->vouchers_count < 1)
                                                    <div class="ribbon-shape shape-right ribbon-danger">Habis</div>
                                                @endif
                                                <input type="radio" class="select-input select-package" name="package"
                                                    value="{{ $p->id}}" @if ($product->is_voucher == 1 && $p->vouchers_count < 1)
                                                    disabled @endif data-vouchers_count="{{ $p->vouchers_count }}">
                                                <div class="card-body  p-3">
                                                    <h5>{{ $p->amount}}</h5>
                                                    <h6>{{ toCurrency($p->price, 'IDN') }}</h6>
                                                </div>

                                            </div>
                                        </div>

                                    @endforeach
                                </div>



                                <div class="product-details-btn text-end mt-4">
                                    {{-- <a href="cart.html" role="button" class="btn btn-primary">Add To Cart</a> --}}

                                    <button href="#" onclick="addToCart()" role="button"
                                        class="btn btn-light-primary button-action" id="cartAddBtn">+
                                        Keranjang</button>
                                    <button onclick="orderNow()" role="button" class="btn btn-primary button-action">Beli
                                        Langsung</button>
                                    {{-- <a href="wishlist.html" role="button" class="btn btn-danger">Add to Wishlist</a>
                                    --}}
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
                                    <h5>Produk Serupa</h5>
                                    <div class="product-details-table">
                                        <table class="table table-bottom-border align-middle products-data-table">
                                            <tbody>
                                                @foreach ($related as $r)
                                                    <tr class="border-0">
                                                        <td>
                                                            <a href="/customer_product_detail/{{$r->id}}">
                                                                <div class="position-relative">
                                                                    <img src="{{ asset('uploads/product/' . $r->product_pic) }}"
                                                                        alt="product-image" class="w-45 h-45 position-absolute">
                                                                    <div class="mg-s-40">
                                                                        <h6 class="text-dark f-w-600 txt-ellipsis-1">
                                                                            {{ $r->name }}
                                                                        </h6>
                                                                        <p class="text-secondary mb-0">{{ $r->game }}</p>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td class="text-end">
                                                            <h6 class="f-s-15 text-success">
                                                                {{ toCurrency($r->product_price, 'IDN') }}
                                                            </h6>
                                                        </td>
                                                    </tr>

                                                @endforeach
                                            </tbody>
                                        </table>
                                        <a role="button" href="/customer_product_list" target="_blank"
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

    <!-- slick-file -->
    <script src="{{ asset('assets/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.js') }}"></script>

    <!-- Toatify js-->
    <script src="{{ asset('assets/vendor/notifications/toastify-js.js') }}"></script>
    <script src="{{ asset('assets/vendor/toastify/toastify.js') }}"></script>


    <script>
        // slick slider js
        // slick slider js
        $('.product-slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.product-slider-nav'
        });
        $('.product-slider-nav').slick({
            slidesToShow: '{{ $attachmentsCount }}',
            slidesToScroll: 1,
            asNavFor: '.product-slider-for',
            dots: false,
            arrows: true,
            centerMode: true,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 1200,
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

        $(`.select-package`).on('click', function (e) {
            $(this).find('input[name="package"]').prop('checked', true);
        })

        function addToCart() {


            let gameId = $(`#gameId`).val();
            let productId = $(`#productId`).val();
            let packageId = $(`input[name="package"]:enabled:checked`).val();
            let vouchers_count = $(`input[name="package"]:enabled:checked`).data('vouchers_count');
            $(`#gameId`).removeClass('is-invalid')
            if (gameId.length < 1 || packageId == undefined) {


                if (gameId.length < 1) $(`#gameId`).addClass('is-invalid')
                Toastify({
                    text: "Mohon isi id game dan pilih salah satu paket!",
                    duration: 2500,
                    position: "right",
                    style: {
                        background: "rgb(var(--danger),1)",
                    }
                }).showToast();
                return false;
            }

            $dataPost = {
                "_token": "{{ csrf_token() }}",
                "productId": productId,
                "gameId": gameId,
                "packageId": packageId,
                "vouchers_count" : vouchers_count,
                "is_voucher": '{{ $product->is_voucher }}'
            }

            $.ajax({
                type: "POST",
                url: "{{ route('customer_cart_add') }}",
                data: $dataPost,
                beforeSend: function () {
                    $('#cartAddBtn').html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Loading');
                    $('.button-action').attr('disabled', true);
                },
                success: function (response) {
                    $('.button-action').attr('disabled', false);
                    $('#cartAddBtn').html('+ Keranjang')
                  
                    if (response.response == "success") {
        

                        let cartCounts = parseInt($('#cartCounts').text());
                        $('#cartCounts').text(cartCounts + 1);

                        let cartTotalCounts = parseInt($('#cartTotalCounts').data('total'));
                        $('#cartTotalCounts').text(`Rp ` + formatIdrs(parseInt(cartTotalCounts) + parseInt(response.carts.product_price)));
                        $('#cartTotalCounts').data('total', parseInt(cartTotalCounts) + parseInt(response.carts.product_price));
                        let element =
                            `<div class="head-box">
                                                                            <img src="{{ asset('uploads/product/${response.carts.product_pic}') }}" alt="cart"
                                                                              class="h-50 object-fit-cover me-3 b-r-10">
                                                                            <div class="flex-grow-1">
                                                                              <a class="mb-0 f-w-600 f-s-16">${response.carts.name}</a><br>
                                                                              <span class="text-secondary text-dark f-w-400">${response.carts.game}</span><br>
                                                                              <span class="text-secondary">${response.carts.package_amount} ${response.carts.unit} - <span class="text-dark f-w-400 row-cart-price" data-price="${response.carts.product_price}">Rp ${formatIdrs(response.carts.product_price)}</span></span>
                                                                            </div>
                                                                            <div class="text-end">
                                                                              <i class="ph ph-trash f-s-25 text-danger" data-cart="${response.carts.cart_id}" onclick="removeCart(this)"></i>

                                                                            </div>
                                                                            </div>`
                        $(element).insertBefore('#emptyCartMessage');
                        Toastify({
                            text: "Berhasil ditambahkan ke keranjang!",
                            duration: 2500,
                            position: "right",
                            style: {
                                background: "rgb(var(--success),1)",
                            }
                        }).showToast();
                        console.log(response.carts);
                        $('#gameId').val('');
                        $('.select-package').prop('checked', false);
                    } else {
                        Toastify({
                            text: "Keranjang melebihi stok!",
                            duration: 2500,
                            position: "right",
                            style: {
                                background: "rgb(var(--danger),1)",
                            }
                        }).showToast();
                    }
                }
            });

        }


        var formatIdrs = function (num) {
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

        function orderNow() {
            let gameId = $(`#gameId`).val();
            let productId = $(`#productId`).val();
            let packageId = $(`input[name="package"]:enabled:checked`).val();

            if (gameId.length < 1 || packageId == undefined) {


                if (gameId.length < 1) $(`#gameId`).addClass('is-invalid')
                Toastify({
                    text: "Mohon isi id game dan pilih salah satu paket!",
                    duration: 2500,
                    position: "right",
                    style: {
                        background: "rgb(var(--danger),1)",
                    }
                }).showToast();
                return false;
            }

            window.location.href = `/customer_order_now/${productId}/${packageId}/${gameId}`;
        }


    </script>
    {{--
    <script src="{{ asset('assets/js/product_details.js') }}"></script> --}}
@endsection