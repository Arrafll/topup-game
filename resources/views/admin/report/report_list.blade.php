@extends('layout.main')
@section('content')
    <!-- Body main section starts -->
    <main>
        <div class="container-fluid">
            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 ">
                    <h4 class="main-title mb-2">Laporan Bulanan</h4>
                    <ul class="app-line-breadcrumbs mb-3">
                        <li class="">
                            <a href="/" class="f-s-14 f-w-500">
                                <span>
                                    KlikTopUp
                                </span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="#" class="f-s-14 f-w-500">Laporan Bulanan</a>
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
                            <div class="col-12 row mb-3">
                                <div class="row col-4">
                                    <div class="col-sm-6">
                                        <select class="form-select" id="year-filter">
                                            <option value="" selected>Pilih Tahun</option>
                                            @foreach ($years as $y)
                                                <option value="{{ $y->year }}">{{ $y->year }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-select" id="month-filter">
                                            <option value="" selected>Pilih Bulan</option>
                                            @foreach ($months as $month => $m)
                                                <option data-month="{{ $month }}" value="{{ $m }}">{{ $m }}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                </div>
                                <div class="col-8 text-end">
                                    <div class="text-end">
                                        <a class="btn btn-md btn-success" href="/admin_report_export" id="exportExcelBtn"><i
                                                class="ti ti-file-spreadsheet"></i>
                                            Excel</a>

                                    </div>
                                </div>
                            </div>
                            <div class="app-datatable-default overflow-auto">
                                <table class="display w-100 row-border-table table-responsive" id="datatableReport">
                                    <thead>
                                        <tr>
                                            <th>Tahun</th>
                                            <th>Bulan</th>
                                            <th>Total Order</th>
                                            <th>Pendapatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reports as $r)
                                            <tr>
                                                <td>{{ $r->year }}</td>
                                                <td>{{ \Carbon\Carbon::create($r->year, $r->month)->monthName }}</td>
                                                <td>{{ $r->total_order }}</td>
                                                <td>{{ toCurrency($r->gross, 'IDN') }}</td>
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

        let reportTable = $("#datatableReport").DataTable({
            dom: 'lrtip', // hilangkan "f" (filter input)
            responsive: true,
            searching: true,    // Hilangkan kotak pencarian
            lengthChange: false,  // Hilangkan dropdown jumlah data per halaman
            order: [[2, 'desc']],
            pageLength: 10
        });

        $('#year-filter').on('change', function () {
            var val = $(this).val();
            let month = $(`#month-filter`).find('option:selected').data('month') + 1;
            if ($('#month-filter').val() != "" && val != "") {
                $(`#exportExcelBtn`).attr('href', `/admin_report_export/${val}/${month}`);
            } else {
                $(`#exportExcelBtn`).attr('href', `/admin_report_export/${val}`);
            }
            reportTable.column(0).search(val).draw(); // 2 = index kolom "Status"

        });
        $('#month-filter').on('change', function () {
            var val = $(this).val();
            let month = $(this).find('option:selected').data('month') + 1;
            if ($('#year-filter').val() != "" && val != "") {
                $(`#exportExcelBtn`).attr('href', `/admin_report_export/${$('#year-filter').val()}/${month}`);
            } else {
                $(`#exportExcelBtn`).attr('href', `/admin_report_export`);
            }
            reportTable.column(1).search(val).draw(); // 2 = index kolom "Status"

        });

    </script>
@endsection