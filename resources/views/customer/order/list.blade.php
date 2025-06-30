@extends('layout.main')
@section('content')
    <!-- Body main section starts -->
    <main>
        <div class="container-fluid">
            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 ">
                    <h4 class="main-title mb-2">Cek Pesanan</h4>
                    <ul class="app-line-breadcrumbs mb-3">
                        <li class="">
                            <a href="/" class="f-s-14 f-w-500">
                                <span>
                                    KlikTopUp
                                </span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="#" class="f-s-14 f-w-500">Cek Pesanan</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Breadcrumb end -->

            <!-- Product List start -->
            <div class="row">
                <div class="col-12">
                    <div class="card">



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
                                                    <a type="button" href="/customer_order_detail/{{ $o->id }}"
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

        function loadSwalDelete(id) {
            Swal.fire({
                title: 'Ingin hapus?',
                text: "Proses hapus tidak bisa dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/admin_product_delete/${id}`
                }
            })
        }

        let orderTable = $("#datatableOrder").DataTable({
            responsive: true,
            order: [[4, 'desc']]
        }
        );


    </script>
@endsection