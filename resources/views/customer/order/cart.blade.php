@extends('layout.main')
@section('content')
    <!-- Body main section starts -->
    <main>
        <div class="container-fluid">
            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 ">
                    <h4 class="main-title">Buat Pesanan</h4>
                    <ul class="app-line-breadcrumbs mb-3">
                        <li class="">
                            <a href="#" class="f-s-14 f-w-500">
                                <span>
                                    <i class="ph-duotone  ph-stack f-s-16"></i> KlikTopUp
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="f-s-14 f-w-500">Order</a>
                        </li>
                        <li class="active">
                            <a href="#" class="f-s-14 f-w-500">Create</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Breadcrumb end -->

            <!-- cart start -->
            <div class="row cart-table">

                <div class="col-lg-8">
                    <div class="card">

                        <div class="card-body p-0">
                            <!-- table -->
                            <div class="app-scroll table-responsive app-datatable-default">
                                <table class="table cart-product-table align-middle datatable-raw">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product</th>
                                            <th scope="col">Game</th>
                                            <th scope="col"> Game ID</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carts as $c)
                                            <tr>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <img src="{{ asset('uploads/product/' . $c->product_pic)}}"
                                                            class="w-50 h-50" alt="">
                                                        <div class="cart-details">
                                                            <p class="fs-6">
                                                                {{ $c->name }}
                                                            </p>
                                                            <p class="f-w-500">{{ $c->package_amount }} {{ $c->unit }}</p>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td>{{ $c->game }}</td>
                                                <td>
                                                    <div>
                                                        {{ $c->game_id }}
                                                    </div>
                                                </td>
                                                <td>{{ toCurrency($c->product_price, 'IDN') }}</td>

                                                <td>
                                                    <button type="button" onclick="removeCartItem('{{ $c->cart_id }}')"
                                                        class="btn btn-outline-danger icon-btn b-r-4 delete-btn">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- table -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Detail Pesanan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table cart-side-table mb-0">
                                            <tbody>
                                                <tr class="total-price">
                                                    <th>Jumlah :</th>
                                                    <th class="text-end">
                                                        <span id="cart-sub">
                                                            {{ $cartList->count('id')}} Item
                                                        </span>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td>Sub Total:
                                                    </td>
                                                    <td class="text-end" id="cart-discount">
                                                        {{ toCurrency($cartList->sum('product_price'), 'IDN') }}
                                                    </td>
                                                </tr>
                                                {{-- <tr>
                                                    <td>Biaya Admin :</td>
                                                    <td class="text-end" id="cart-shipping">Rp 2.500</td>
                                                </tr> --}}
                                                <tr class="total-price">
                                                    <th>Total :</th>
                                                    <th class="text-end">
                                                        <span id="cart-total">
                                                            {{ toCurrency($cartList->sum('product_price'), 'IDN') }}
                                                        </span>
                                                    </th>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <form action="/customer_order_add" method="post" id="formCheckout">
                                        <div class="row">
                                            @csrf
                                            <div class="mt-2 col-sm-12">
                                                <textarea class="form-control form-product" id="textareaexample3"
                                                    name="descOrder" placeholder="Tulis Catatan..." rows="4"></textarea>
                                            </div>

                                        </div>
                                        <div class="text-end mt-4 col-12">
                                            <button class="btn btn-primary col-12" id="checkout-button">Buat
                                                Pesanan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- cart end -->
        </div>
        @session('successEdit')
            <script>
                Toastify({
                    text: "{{ session('successEdit') }}",
                    duration: 2500,
                    position: "right",
                    style: {
                        background: "rgb(var(--success), 1)",
                    }
                }).showToast();
            </script>
        @endsession
    </main>

    <!-- Body main section ends -->
    <script src="{{ asset('assets/vendor/sweetalert/sweetalert.js') }}"></script>
    <script src="{{ asset(path: 'assets/vendor/toastify/toastify.js') }}"></script>

    <script>

        function removeCartItem(id) {
            Swal.fire({
                title: 'Hapus item ini?',
                text: "Proses hapus tidak bisa dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/customer_cart_delete_sync/${id}`
                }
            })
        }
    </script>
@endsection