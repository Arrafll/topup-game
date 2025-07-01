@extends('layout.main')
@section('content')
    <!-- Body main section starts -->
    <main>
        <div class="container-fluid">
            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 ">
                    <h4 class="main-title">User List</h4>
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
                            <a href="#" class="f-s-14 f-w-500">User List</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Breadcrumb end -->

            <!-- User List start -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>User List</h5>
                            <p>List data akun yang sudah terdaftar.
                                Anda dapat menambah, mengubah, dan menghapus data akun di sini.
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
                            <div class="app-datatable-default overflow-auto">
                                <table class="display w-100 row-border-table table-responsive datatable-original">
                                    <thead>
                                        <tr>
                                         
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Tanggal Diubah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $u)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div
                                                            class="h-30 w-30 d-flex-center b-r-50 overflow-hidden text-bg-info">
                                                            @if (isset($u->user_pic))
                                                                <img src="{{ asset('uploads/user/' . $u->user_pic) }}" alt=""
                                                                    class="img-fluid">
                                                            @else
                                                                <img src="../assets/images/avtar/4.png" alt="" class="img-fluid">
                                                            @endif

                                                        </div>
                                                        <p class="mb-0 ps-2"> {{ $u->name }}</p>
                                                    </div>
                                                </td>
                                                <td>{{ $u->email }}</td>
                                                <td>{{ $u->role_name }}</td>
                                                <td>{{ $u->created_at }}</td>
                                                <td>{{ $u->updated_at }}</td>
                                                <td>
                                                    <a type="button" href="/admin_user_edit/{{ $u->id }}"
                                                        class="btn btn-light-success icon-btn w-30 h-30 b-r-22 me-2">
                                                        <i class="ti ti-edit"></i></a>
                                                    <button type="button"
                                                        class="btn btn-light-danger icon-btn w-30 h-30 b-r-22 delete-btn" onclick="loadSwalDelete('{{ $u->id }}')"><i
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
            <!-- User List end -->
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
                    window.location.href = `/admin_user_delete/${id}`
                }
            })
        }

    </script>
@endsection