@extends('layout.main')
@section('content')
    <!-- Body main section starts -->
    <main>
        <div class="container-fluid">
            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 ">
                    <h4 class="main-title">Orders Details</h4>
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
                            <a href="#" class="f-s-14 f-w-500">Orders Details</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Breadcrumb end -->

            <!-- Order Details start -->
            <div class="row order-details">
                <div class="col-xxl-9">
                    <div class="row">
                        <!-- Order Details start -->
                        <div class="col-lg-4">
                            <div class="card order-details-card">
                                <div class="card-header">
                                    <h5 class="text-nowrap">Informasi Customer</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="f-w-600 text-dark">
                                            <i class="ti ti-user"></i> Nama
                                        </h6>
                                        <div class="text-end">
                                            <p>{{ $order->user->name }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-3">
                                        <h6 class="f-w-600 text-dark">
                                            <i class="ti ti-mail"></i> Email
                                        </h6>
                                        <div class="text-end">
                                            <p>{{ $order->user->email }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-3">
                                        <h6 class="f-w-600 text-dark">
                                            <i class="ti ti-phone"></i> Handphone
                                        </h6>
                                        <div class="text-end">
                                            @if (Auth::user()->phone == NULL)
                                                <p>-</p>
                                            @else
                                                <p>{{ $order->user->handphone }}</p>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Order Details end -->

                        <!-- Documents start -->
                        <div class="col-lg-4">
                            <div class="card order-details-card">
                                <div class="card-header">
                                    <h5>Detail</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="f-w-600 text-dark"><i class="ti ti-calendar-stats"></i> Dibuat
                                        </h6>
                                        <div class="text-end">
                                            <p>{{ $order->created_at }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-3">
                                        <h6 class="f-w-600 text-dark">
                                            <i class="ti ti-calendar-time"></i> Diubah
                                        </h6>
                                        <div class="text-end">
                                            {{ $order->updated_at }}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-3">
                                        <h6 class="f-w-600 text-dark">
                                            <i class="ti ti-garden-cart"></i> Status
                                        </h6>
                                        <div class="text-end">
                                            {!! getStatusLabel($order->status) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Documents end -->
                        <div class="col-lg-4">
                            <div class="card order-details-card">
                                <div class="card-header">
                                    <h5>Pembayaran</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="f-w-600 text-dark">
                                            <i class="ti ti-credit-card"></i> Metode
                                        </h6>
                                        <div class="text-end">
                                            @if (empty($order->pay_method))
                                                <p>-</p>
                                            @else
                                                <p>{{ getPayMethod($order->pay_method) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-3">
                                        <h6 class="f-w-600 text-dark">
                                            <i class="ti ti-report"></i> Tanggal
                                        </h6>
                                        <div class="text-end">
                                            @if (empty($order->payed_at))
                                                <p>-</p>
                                            @else
                                                <p>{{ $order->payed_at }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-3">
                                        <h6 class="f-w-600 text-dark">
                                            <i class="ti ti-tag"></i> Status
                                        </h6>
                                        <div class="text-end">
                                            {!! getStatusLabel($order->pay_status) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order start -->
                    <div class="card">
                        <div class="card-header row">
                            <div class="col-6">
                                <h5>
                                    Order : #{{ $order->code }}
                                </h5>
                            </div>
                            <div class="col-6 text-end">
                                <div class="text-end">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalNotes"><i class="ti ti-paperclip"></i> Catatan</button>

                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <form action="/admin_order_finish" method="POST" id="finishOrder">
                                @csrf
                                <input type="hidden" name="orderId" value="{{ $order->id }}">
                                <div class="orders-details-datatable app-datatable-default app-scroll table-responsive">
                                    <table class="table table-bottom-border text-center align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-start">Product Details</th>
                                                <th>Game</th>
                                                <th scope="col">Game ID</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Tanggal Pesan</th>
                                                <th scope="col">Kode Voucher</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($orders as $o)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <img src="{{ asset('uploads/product/' . $o->product_pic)}}"
                                                                alt="product-img" class="h-50 bg-light-secondary b-r-10">
                                                            <div class="text-start">
                                                                <h6 class="mb-0">{{ $o->game }}</h6>
                                                                <p class="f-w-500 m-0 text-muted f-s-13">
                                                                    <span class="text-secondary">{{ $o->package_amount}}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $o->game }}</td>
                                                    <td>{{ $o->game_id }}</td>
                                                    <td>{{ toCurrency($o->product_price, 'IDN') }}</td>
                                                    <td>{{ $o->order_date }}</td>
                                                    <input type="hidden" name="itemIds[]" value="{{ $o->item_id }}">
                                                    <input type="hidden" name="voucherIds[]"
                                                        value="{{ $o->available_voucher_id }}"
                                                        data-is_voucher="{{ $o->is_voucher }}" class="voucherIds">
                                                    @if ($order->status == "Processed")
                                                        <td class="text-center" width="10%">
                                                            @if ($o->is_voucher == "1")
                                                                @if ($o->available_voucher_id)
                                                                    <div class="d-flex flex-column align-items-center">
                                                                        <div class="position-relative" data-bs-toggle="tooltip"
                                                                            data-bs-placement="top"
                                                                            title="Kode: {{ $o->available_voucher }}">
                                                                            <i class="ti ti-ticket fs-4 text-primary"></i>
                                                                        </div>
                                                                        <span
                                                                            class="badge bg-light-secondary text-dark mt-1">#{{ $o->available_voucher_id }}</span>
                                                                    </div>
                                                                @else
                                                                    <span class="text-warning">Voucher tidak tersedia</span>
                                                                @endif
                                                            @else
                                                                <span class="text-success">Produk tanpa voucher</span>
                                                            @endif
                                                        </td>
                                                    @else
                                                        <td class="text-center" width="10%">
                                                            @if ($o->used_voucher_code && $o->used_voucher_id)
                                                                <div class="d-flex flex-column align-items-center">
                                                                    <div class="position-relative" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        title="Kode Redeem: {{ $o->used_voucher_code }}">
                                                                        <i class="ti ti-ticket fs-4 text-success"></i>
                                                                    </div>
                                                                    <span
                                                                        class="badge bg-light text-dark mt-1">#{{ $o->used_voucher_id }}</span>
                                                                </div>
                                                            @else
                                                                <span class="text-success">Produk tanpa voucher</span>
                                                            @endif
                                                        </td>
                                                    @endif




                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                        </form>
                        <div class="card-footer">
                            @if ($order->status == "Processed")
                                <div class="col-12">
                                    <div class="text-end">
                                        <a onclick="cancelOrder('{{$order->id}}')" class="btn btn-light-danger">Batalkan</a>
                                        <a onclick="finishOrder()" class="btn btn-primary">Selesaikan</a>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                    <!-- Order end -->

                </div>
                <!-- Order Status start -->
                <div class="col-xxl-3">

                    <div class="card">
                        <div class="card-header">
                            <h5>Order Status</h5>
                        </div>
                        <div class="card-body">
                            <ul class="app-timeline-box">

                                <li class="timeline-section">
                                    <div class="timeline-icon">
                                        <span class="text-light-primary h-35 w-35 d-flex-center b-r-50">
                                            <i class="ti ti-shopping-cart f-s-20"></i>
                                        </span>
                                    </div>
                                    <div class="timeline-content bg-light-primary b-1-primary">
                                        <div class="d-flex justify-content-between align-items-center timeline-flex">
                                            <h6 class="mt-2 text-primary">Pesanan Dibuat</h6>

                                        </div>
                                        <p class="mt-2 text-primary">Pesanan telah dibuat</p>
                                        <p class="text-secondary">
                                            {{ \Carbon\Carbon::parse($order->created_at)->diffForHumans() }}
                                        </p>
                                    </div>
                                </li>


                                @if ($order->pay_status == "Paid" || $order->pay_status == "Refunded")

                                    <li class="timeline-section">
                                        <div class="timeline-icon">
                                            <span class="text-light-secondary h-35 w-35 d-flex-center b-r-50">
                                                <i class="ph ph-credit-card"></i>
                                            </span>
                                        </div>
                                        <div class="timeline-content bg-light-secondary b-1-secondary">
                                            <div class="d-flex justify-content-between align-items-center timeline-flex">
                                                <h6 class="mt-2 text-secondary">Pesanan Dibayar</h6>
                                            </div>
                                            <p class="mt-2">
                                                Pesanan telah dibayar
                                            </p>
                                            <p class="text-secondary">
                                                {{ \Carbon\Carbon::parse($order->payed_at)->diffForHumans() }}
                                            </p>
                                        </div>
                                    </li>
                                @endif
                                @if ($order->status == "Processed" || !empty($order->processed_at))
                                    <li class="timeline-section">
                                        <div class="timeline-icon">
                                            <span class="text-light-info h-35 w-35 d-flex-center b-r-50">
                                                <i class="ph ph-package"></i>
                                            </span>
                                        </div>
                                        <div class="timeline-content bg-light-info b-1-info">
                                            <div class="d-flex justify-content-between align-items-center timeline-flex">
                                                <h6 class="mt-2 text-info">Pesanan Di Proses</h6>
                                            </div>
                                            <p class="mt-2 text-info">
                                                Pesanan dalam proses admin
                                            </p>
                                            <p class="text-secondary">
                                                {{ \Carbon\Carbon::parse($order->processed_at)->diffForHumans() }}
                                            </p>
                                        </div>
                                    </li>
                                @endif
                                @if ($order->status == "Cancelled")

                                    <li class="timeline-section">
                                        <div class="timeline-icon">
                                            <span class="text-light-danger h-35 w-35 d-flex-center b-r-50">
                                                <i class="ph ph-receipt-x"></i>
                                            </span>
                                        </div>
                                        <div class="timeline-content bg-light-danger b-1-danger">
                                            <div class="d-flex justify-content-between align-items-center timeline-flex">
                                                <h6 class="mt-2 text-danger">Pesanan Dibatalkan</h6>
                                            </div>
                                            <p class="mt-2 text-danger">
                                                Pesanan telah dibatalkan
                                            </p>
                                            <p class="text-danger">
                                                {{ \Carbon\Carbon::parse($order->finished_at)->diffForHumans() }}
                                            </p>
                                        </div>
                                    </li>
                                @endif
                                @if ($order->status == "Done")
                                    <li class="timeline-section">
                                        <div class="timeline-icon">
                                            <span class="text-light-success h-35 w-35 d-flex-center b-r-50">
                                                <i class="ph ph-arrow-square-left"></i>
                                            </span>
                                        </div>
                                        <div class="timeline-content bg-light-success b-1-success">
                                            <div class="d-flex justify-content-between align-items-center timeline-flex">
                                                <h6 class="mt-2 text-success">Selesai</h6>
                                            </div>
                                            <p class="mt-2 text-success">
                                                Voucher berhasil dikirim
                                            </p>
                                            <p class="text-secondary">
                                                {{ \Carbon\Carbon::parse($order->finished_at)->diffForHumans() }}
                                            </p>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <!-- Order Status end -->

                </div>
                <!-- Order Details end -->
            </div>
            <!-- Order Details end -->
        </div>
        <!-- Full-screen-md-down modal start  -->
        <div class="modal fade" id="modalNotes" tabindex="-1" aria-labelledby="modalNotesLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen-md-down">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modalNotesLabel">Catatan</h6>
                        <button type="button" class="btn-close m-0 fs-5" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ $order->note }} </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Full-screen-md-down modal end -->
    </main>
    <!-- Body main section ends -->

    <script src="{{ asset('assets/vendor/sweetalert/sweetalert.js') }}"></script>

    @session('cancel')
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Pesanan dibatalkan!',
                text: "{{ session('cancel') }}"
            })
        </script>
    @endsession
    @session('finish')
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('finish') }}"
            })
        </script>
    @endsession
    <script>
        function cancelOrder(id) {
            Swal.fire({
                title: 'Batalkan pemesanan?',
                text: "Pesanan dibatalkan dan payment akan direfund!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, batalkan',
                cancelButtonText: 'Tidak',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/admin_order_cancel/${id}`
                }
            })
        }


        function finishOrder() {
            Swal.fire({
                title: 'Selesaikan pesanan?',
                text: "Pastikan seluruh formulir sudah valid, kosongkan kode voucher jika game memang tidak memiliki voucher",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Tidak',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    submitOrder();
                }
            })
        }

        function submitOrder() {
            let isValid = true;
            $(`.voucherIds`).each(function () {
                if ($(this).data('is_voucher') == 1) {
                    if ($(this).val() == "") isValid = false;
                }
            })
            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Pesanan gagal diselesaikan!',
                    text: "Terdapat produk bervoucher yang tidak memiliki kode voucher"
                })
                return false;
            }

            $(`#finishOrder`).submit();
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>

@endsection