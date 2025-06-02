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
                            <div class="col-sm-12 m-b-sm">
                                <div class="col-sm-6">
                                    <a href="{{ route('admin_product_add') }}"  class="btn btn-primary btn-md"> <i class="ti ti-plus"></i> Tambah</a>
                                </div>
                            </div>
                            <div class="app-datatable-default overflow-auto">
                                <table class="display w-100 row-border-table table-responsive datatable-original">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
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
                                                            <img src="../assets/images/avtar/4.png" alt="" class="img-fluid">
                                                        </div>
                                                        <p class="mb-0 ps-2"> {{ $p->name }}</p>
                                                    </div>
                                                </td>
                                                <td>{{ $p->category }}</td>
                                                <td>{{ toCurrency($p->price, 'IDN') }}</td>
                                                <td>{{ $p->created_at }}</td>
                                                <td>{{ $p->modified_at }}</td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-light-success icon-btn w-30 h-30 b-r-22 me-2"
                                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                        <i class="ti ti-edit"></i></button>
                                                    <button type="button"
                                                        class="btn btn-light-danger icon-btn w-30 h-30 b-r-22 delete-btn"><i
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
@endsection
@yield('product_form_script')