@extends('layout.main')
<!-- Body main section starts -->
@section('content')
    <main>
        <div class="container-fluid">
            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 ">
                    <h4 class="main-title mb-2">Detail Pesanan</h4>
                    <ul class="app-line-breadcrumbs mb-3">
                        <li class="">
                            <a href="{{ route('home') }}" class="f-s-14 f-w-500">
                                <span>
                                    KlikTopup
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customer_order_list') }}" class="f-s-14 f-w-500">Cek Pesanan</a>
                        </li>
                        <li class="active">
                            <a href="#" class="f-s-14 f-w-500">Detail Pesanan</a>
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
                                    <h5 class="text-nowrap">Informasi Akun</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="f-w-600 text-dark">
                                            <i class="ti ti-user"></i> Nama
                                        </h6>
                                        <div class="text-end">
                                            <p>{{ Auth::user()->name }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-3">
                                        <h6 class="f-w-600 text-dark">
                                            <i class="ti ti-mail"></i> Email
                                        </h6>
                                        <div class="text-end">
                                            <p>{{ Auth::user()->email }}</p>
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
                                                <p>{{ Auth::user()->phone }}</p>
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
                        <!-- Customer Details start -->
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
                        <!-- Customer Details end -->


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
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalNotes"><i class="ti ti-paperclip"></i> Catatan</button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="orders-details-datatable app-datatable-default app-scroll table-responsive">
                                <table class="table table-bottom-border text-center align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-start">Product Details</th>
                                            <th>Game</th>
                                            <th scope="col"> Game ID</th>
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
                                                            <h6 class="mb-0">{{ $o->name }}</h6>
                                                            <p class="f-w-500 m-0 text-muted f-s-13">
                                                                <span
                                                                    class="text-secondary">{{ $o->package_amount . ' ' . $o->unit }}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $o->game }}</td>
                                                <td>{{ $o->game_id}} </td>
                                                <td>{{ toCurrency($o->product_price, 'IDN') }}</td>
                                                <td>{{ $o->order_date}} </td>
                                                <td class="text-center">
                                                    @if($o->is_voucher == "1")
                                                        @if ($o->voucher_id)
                                                            <div class="d-flex flex-column align-items-center">
                                                                <div class="position-relative" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="Kode Redeem: {{ $o->voucher_redeem_code }}&#10;">
                                                                    <i class="ti ti-ticket fs-4 text-success"></i>
                                                                </div>
                                                                <span
                                                                    class="badge bg-light-secondary text-dark mt-1">#{{ $o->voucher_id }}</span>
                                                            </div>
                                                        @else
                                                            <span class="text-success">-</span>
                                                        @endif
                                                    @else
                                                        <span class="text-success">Produk tanpa voucher</span>
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <p class="text-secondary">Showing 1 to 6 of 24 order entries</p>
                            </div>
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
                    @if (empty($order->payed_at) && empty($order->finished_at))
                        <div class="card">
                            <div class="card-header">
                                <h5>Detail Pembayaran</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table cart-side-table mb-0">
                                        <tbody>
                                            <tr class="total-price">
                                                <th>Jumlah :</th>
                                                <th class="text-end">
                                                    <span id="cart-sub">
                                                        {{ $orders->count('id')}} Item
                                                    </span>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td>Sub Total:
                                                </td>
                                                <td class="text-end" id="cart-discount">
                                                    {{ toCurrency($orders->sum('product_price'), 'IDN') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Biaya Admin :</td>
                                                <td class="text-end" id="cart-shipping">Rp 2.500</td>
                                            </tr>
                                            <tr class="total-price">
                                                <th>Total :</th>
                                                <th class="text-end">
                                                    <span id="cart-total">
                                                        {{ toCurrency($orders->sum('product_price') + 2500, 'IDN') }}
                                                    </span>
                                                </th>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <form action="/customer_checkout" method="post" id="formPayment">
                                    @csrf
                                    <input type="hidden" name="orderId" value="{{ $order->id }}">
                                    <input type="hidden" name="jsonMidtrans" value="" id="jsonMidtrans">
                                </form>
                                <div class="row">
                                    <div class="text-end mt-4 col-12">
                                        <button class="btn btn-success col-12 mb-2" id="checkout-button">Bayar</button>
                                        <button class="btn btn-light-danger col-12"
                                            onclick="cancelOrder('{{ $order->id }}')">Batalkan
                                            Pesanan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- Order Status end -->

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
                            <button type="button" class="btn btn-light-secondary btn-sm"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Full-screen-md-down modal end -->
    </main>

    <script src="{{ asset('assets/vendor/sweetalert/sweetalert.js') }}"></script>

    @session('cancel')
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Berhasil Dibatalkan',
                text: "{{ session('cancel') }}"
            })
        </script>
    @endsession
    @session('paid')
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Pembayaran Berhasil',
                text: "{{ session('paid') }}"
            })
        </script>
    @endsession
    <script>
        function cancelOrder(id) {
            Swal.fire({
                title: 'Batalkan pemesanan?',
                text: "Proses batal tidak bisa diubah kembali!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, batalkan',
                cancelButtonText: 'Tidak',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/customer_order_cancel/${id}`
                }
            })
        }
    </script>
    @if (empty($order->payed_at))

        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
        <script type="text/javascript">
            document.getElementById('checkout-button').onclick = function () {
                // SnapToken acquired from previous step
                snap.pay('<?=$snapToken?>', {
                    // Optional
                    onSuccess: function (result) {
                        document.getElementById('jsonMidtrans').value = JSON.stringify(result, null, 2);
                        $('#formPayment').submit();
                    },
                    // Optional
                    onPending: function (result) {
                        document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    },
                    // Optional
                    onError: function (result) {
                        document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    }
                });
            };

        </script>

    @endif

@endsection