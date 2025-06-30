@extends('layout.main')
@section('content')

    <!-- toastify css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/toastify/toastify.css') }}">
    <!-- glight css -->


    <link rel="stylesheet" href="{{ asset('assets/vendor/glightbox/glightbox.min.css') }}">
    <style>
        .person-details {
            width: 100%;
            text-align: center;
            padding: 0.5rem;
            border-radius: 6px;

        }
    </style>
    <main>
        <div class="container-fluid">
            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 ">
                    <h4 class="main-title">Edit User</h4>
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
                            <a href="#" class="f-s-14 f-w-500">Edit User</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Breadcrumb end -->

            <!-- Add Product start -->
            <div class="row">
                <div class="col-lg-6 col-xxl-6">
                    <div class="card">
                        <div class="card-body">
                            <form class="app-form" method="POST" id="form-add-user"
                                action="{{ route('admin_user_update') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="userId" value="{{ $user->id }}">
                                <div class="app-user-section">
                                    <div class="main-title">
                                        <h6>General Information</h6>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <div class="mb-3 col-sm-12">
                                                <label class="form-label">Nama <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-user-required" name="name"
                                                    placeholder="Isi nama user..." value="{{ old('name', $user->name) }}">
                                            </div>
                                            <div class="mb-3 col-sm-12">
                                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email"
                                                    class="form-control form-user-required  @error('email') is-invalid @enderror"
                                                    name="email" placeholder="Isi email..."
                                                    value="{{ old('email', $user->email) }}">
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3 col-sm-12">
                                                <label class="form-label">Password </label>
                                                <input type="password" class="form-control form-user" name="password"
                                                    id="password1" placeholder="Isi password...">
                                            </div>
                                            <div class="mb-3 col-sm-12">
                                                <label class="form-label">Ketik Ulang Password</span></label>
                                                <input type="password" class="form-control form-user" name="password2"
                                                    id="password2" placeholder="Ketik ulang password...">
                                            </div>
                                        </div>
                                    </div>


                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xxl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="app-user-section">

                                <div class="main-title">
                                    <h6>Detail User</h6>
                                </div>

                                <div>
                                    <div class="row app-form">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Role <span class="text-danger">*</span></label>
                                                <select class="form-select form-user-required" id="city" name="role"
                                                    value="{{ old('role', $user->role_id) }}">
                                                    <option value="" selected>Pilih Role</option>
                                                    @foreach ($roles as $item)
                                                        <option value="{{ $item->id }}" @if ($item->id == $user->role_id) selected
                                                        @endif>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Handphone <span class="text-danger">*</span></label>
                                            <div class="input-group" id="content">
                                                <span class="input-group-text">+62</span>
                                                <input type="text" class="form-control" name="handphone" placeholder="Isi nomor handphone..." id="handphoneForm" value="{{ old('handphone', $user->handphone) }}">
                                            </div>
                                        </div>
                                        <div class="mb-3 col-sm-12">
                                            <label class="form-label">Alamat <span class="text-danger">*</span></label>
                                            <textarea class="form-control form-user-required" id="textareaexample3"
                                                name="alamat" placeholder="Isi alamat..."
                                                rows="6">{{ old('alamat', $user->alamat) }}</textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <div
                                                class="mt-4 d-flex justify-content-end gap-2 flex-column flex-sm-row text-end">
                                                <button type="reset" class="btn btn-light-secondary">Reset</button>
                                                <button type="submit" role="button" class="btn btn-primary">
                                                    Update</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
            <!-- Add Product end -->
        </div>
    </main>
    <!-- Toatify js-->
    <script src="{{ asset('assets/vendor/notifications/toastify-js.js') }}"></script>
    <script src="{{ asset('assets/vendor/toastify/toastify.js') }}"></script>

    <script>

    </script>
    <script>

        $('#handphoneForm').on('keypress', function (e) {
            return e.metaKey || // cmd/ctrl
                e.which <= 0 || // arrow keys
                e.which == 8 || // delete key
                /[0-9]/.test(String.fromCharCode(e.which)); // numbers
        })

        const formUser = document.getElementById("form-add-user");
        formUser.addEventListener("submit", function (e) {
            e.preventDefault();
            let isValid = true;

            $(`.form-user`).removeClass(`is-invalid`);
            $(`.invalid-feedback`).remove();

            $(`.form-user-required`).each(function () {
                if ($(this).val() == "") {
                    $(this).addClass('is-invalid');
                    $(this).after(`<div class="invalid-feedback">
                                                    Formulir tidak boleh kosong!
                                                </div>`)
                    isValid = false;
                }
            })

            if ($(`#password1`).val() != "" || $(`#password2`).val() != "") {
                if ($(`#password2`).val() != $(`#password1`).val()) {
                    $(`#password2`).addClass('is-invalid')
                    $(`#password2`).after(`<div class="invalid-feedback">
                                                    Konfirmasi password harus sama!
                                                </div>`)
                }
            }

            if (isValid == false) {

                Toastify({
                    text: "Gagal menambahkan! Mohon pastikan seluruh formulir terisi",
                    duration: 2500,
                    position: "right",
                    style: {
                        background: "rgb(var(--danger),1)",
                    }
                }).showToast();

                return false;

            }
            $('#form-add-user').submit();

        });



    </script>
    <!-- Glight js -->

    <script src="{{ asset('assets/vendor/glightbox/glightbox.min.js') }}"></script>
    <script>
        GLightbox({
            touchNavigation: true,
            loop: true,
            width: "90vw",
            height: "90vh",
        });

    </script>
@endsection