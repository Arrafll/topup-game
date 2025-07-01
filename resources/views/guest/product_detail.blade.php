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
                            <a href="{{ route('beranda') }}" class="f-s-14 f-w-500">
                                <span>
                                 </i> KlikTopup
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="/guest_product_list" class="f-s-14 f-w-500">Games</a>
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
                                <div class="product-detailbox mt-3 row">

                                    <input type="hidden" value="{{ $product->id }}" id="productId">
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
                                                <input type="radio" class="select-input select-package" name="package"
                                                    value="{{ $p->id}}">
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

                                    <a href="/login" role="button" class="btn btn-light-primary button-action"
                                        id="cartAddBtn">+
                                        Keranjang</a>
                                    <a href="/login" role="button" class="btn btn-primary button-action">Beli
                                        Langsung</a>
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
                                                            <a href="/guest_product_detail/{{$r->id}}">
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
                                        <a role="button" href="/guest_product_list" target="_blank"
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


    </script>
    {{--
    <script src="{{ asset('assets/js/product_details.js') }}"></script> --}}
@endsection