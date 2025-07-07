@extends('layout.main')
@section('content')
    <!-- Body main section starts -->
    <main>
        <div class="container-fluid">
            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 ">
                    <h4 class="main-title">Product List</h4>
                    <ul class="app-line-breadcrumbs mb-3">
                        <li class="">
                            <a href="/" class="f-s-14 f-w-500">
                                <span>
                                    KlikTopUp
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="f-s-14 f-w-500">Data Management</a>
                        </li>
                        <li class="active">
                            <a href="#" class="f-s-14 f-w-500">Product List</a>
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
                            <h5>Product List</h5>
                            <p>List data produk yang terdaftar pada website.
                                Anda dapat menambah, mengubah, dan menghapus data produk di sini.
                            </p>

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
                            <div class="col-sm-12 m-b-sm">
                                <div class="col-sm-6">
                                    <a href="{{ route('admin_product_add') }}" class="btn btn-primary btn-md"> <i
                                            class="ti ti-plus"></i> Tambah</a>
                                </div>
                            </div>
                            <div class="app-datatable-default overflow-auto">
                                <table class="display w-100 row-border-table table-responsive datatable-original">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Kategori</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Tanggal Diubah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $p)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div
                                                            class="h-30 w-30 d-flex-center b-r-50 overflow-hidden text-bg-info">
                                                            @if (isset($p->product_pic))
                                                                <img src="{{ asset('uploads/product/' . $p->product_pic) }}" alt=""
                                                                    class="img-fluid">
                                                            @else
                                                                <img src="../assets/images/avtar/4.png" alt="" class="img-fluid">
                                                            @endif

                                                        </div>
                                                        <p class="mb-0 ps-2"> {{ $p->name }}</p>
                                                    </div>
                                                </td>
                                                <td>{{ $p->category_name }}</td>
                                                <td>{{ $p->created_at }}</td>
                                                <td>{{ $p->updated_at }}</td>
                                                <td>
                                                    <a type="button" href="/admin_product_edit/{{ $p->id }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Product {{$p->name}}"
                                                        class="btn btn-light-success icon-btn w-30 h-30 b-r-22 me-2">
                                                        <i class="ti ti-edit"></i></a>
                                                    <button type="button"
                                                        class="btn btn-light-danger icon-btn w-30 h-30 b-r-22 delete-btn" onclick="loadSwalDelete('{{ $p->id }}')"><i
                                                            class="ti ti-trash"></i></button>
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

    </script>
@endsection