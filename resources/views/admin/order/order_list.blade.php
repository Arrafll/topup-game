@extends('layout.main')
@section('content')
    <!-- Body main section starts -->
    <main>
        <div class="container-fluid">
            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 ">
                    <h4 class="main-title mb-2">Order List</h4>
                    <ul class="app-line-breadcrumbs mb-3">
                        <li class="">
                            <a href="/" class="f-s-14 f-w-500">
                                <span>
                                    KlikTopUp
                                </span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="#" class="f-s-14 f-w-500">Order List</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Breadcrumb end -->

            <!-- Product List start -->
            <div class="row">
                <div class="col-12">
                    <div class="card">


                        <div class="card-header">
                            <ul class="nav nav-tabs app-tabs-primary order-tabs d-flex justify-content-start border-0 mb-0 pb-0"
                                id="Outline" role="tablist">

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active d-flex align-items-center gap-1" id="discover-tab"
                                        data-bs-toggle="tab" data-bs-target="#discover-tab-pane" type="button" role="tab"
                                        aria-controls="discover-tab-pane" aria-selected="false" tabindex="-1"
                                        onclick="filterTableOrder('Dalam Proses')"> <i
                                            class="ti ti-truck-delivery f-s-18 mg-b-3"></i>
                                        Diproses</button>
                                </li>
                            
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link d-flex align-items-center gap-1" id="order-tabs"
                                        data-bs-toggle="tab" data-bs-target="#order-tab-returns" type="button" role="tab"
                                        aria-controls="order-tab-returns" aria-selected="false" tabindex="-1" onclick="filterTableOrder('Selesai')"><i
                                            class="ti ti-checkbox f-s-18 mg-b-3"></i>
                                        Selesai</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link d-flex align-items-center gap-1" id="ordertab"
                                        data-bs-toggle="tab" data-bs-target="#order-tab-cancelled" type="button" role="tab"
                                        aria-controls="order-tab-cancelled" aria-selected="false" tabindex="-1" onclick="filterTableOrder('Dibatalkan')"><i
                                            class="ti ti-square-rounded-x f-s-18 mg-b-3"></i> Dibatalkan</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link d-flex align-items-center gap-1" id="connect-tab"
                                        data-bs-toggle="tab" data-bs-target="#connect-tab-pane" type="button" role="tab"
                                        aria-controls="connect-tab-pane" aria-selected="true" onclick="filterTableOrder()">
                                        <i class="ti ti-sort-descending-2 f-s-18 mg-b-3"></i> All Orders </button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            @session('success')
                                <div class="alert alert-session mb-2 alert-light-border-success d-flex align-items-center justify-content-between"
                                    role="alert" id="myAlert">
                                    <p class="mb-0">
                                        <i class="ti ti-circle-check f-s-18 me-2"></i> {{ session('success') }}
                                    </p>
                                    <i class="ti ti-x" data-bs-dismiss="alert"></i>
                                </div>
                            @endsession
                            <div class="app-datatable-default overflow-auto">
                                <table class="display w-100 row-border-table table-responsive" id="datatableOrder">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Status</th>
                                            <th>Status Pembayaran</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $o)
                                            <tr>
                                                <td>
                                                    #{{ $o->code }}
                                                </td>
                                                <td>{!! getStatusLabel($o->status) !!}</td>
                                                <td>{!! getStatusLabel($o->pay_status) !!}</td>
                                                @if (empty($o->pay_status))
                                                    <td>-</td>
                                                @else
                                                    <td>{!! getPayMethod($o->pay_method) !!}</td>
                                                @endif

                                                <td>{{ $o->created_at }}</td>
                                                <td>
                                                    <a type="button" href="/admin_order_detail/{{ $o->id }}"
                                                        class="btn btn-light-success icon-btn w-30 h-30 b-r-22 me-2">
                                                        <i class="ti ti-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product List end -->
        </div>
    </main>
    <!-- Body main section ends -->
    <!-- sweetalert js-->
    <script src="{{ asset('assets/vendor/sweetalert/sweetalert.js') }}"></script>
    <script>
        $(document).ready(function (params) {
            $(".alert-session").delay(5000).fadeOut(300, function () {
                $(this).remove();
            });
        })

        let orderTable = $("#datatableOrder").DataTable();

        function filterTableOrder(val = '') {
            orderTable.column(1).search(val).draw(); // 2 = index kolom "Status"
        }
        filterTableOrder('Dalam Proses');

    </script>
@endsection