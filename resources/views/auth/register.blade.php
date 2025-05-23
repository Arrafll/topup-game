<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Multipurpose, super flexible, powerful, clean modern responsive bootstrap 5 admin template">
    <meta name="keywords"
        content="admin template, ra-admin admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="la-themes">
    <link rel="icon" href="{{ asset('assets/images/logo/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png')}}" type="image/x-icon">

    <title>Sign Up | KlikTopUp </title>

    <!--font-awesome-css-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/css/all.css') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">

    <!-- tabler icons-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/tabler-icons/tabler-icons.css') }}">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">

</head>

<body class="sign-in-bg">
    <div class="app-wrapper d-block">
        <div class="main-container">
            <!-- sign up start -->
            <div class="container">
                <div class="row sign-in-content-bg">
                    <div class="col-lg-6 image-contentbox d-none d-lg-block">
                        <div class="form-container">

                            <div class="signup-content mt-4">
                                <span>
                                    <img src="{{ asset('assets/images/logo/1.png')}}" alt="" class="img-fluid ">
                                </span>
                            </div>
                            <div class="signup-bg-img">
                                <img src="{{ asset('assets/images/login/02.png')}}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 form-contentbox">
                        <div class="form-container">

                            <form class="app-form" action="{{ route('signup') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-5 text-center text-lg-start">
                                            <h2 class="text-primary f-w-600">Create Account</h2>
                                            <p>Get Started For Free Today!</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="fullname" class="form-label">Nama</label>
                                            <input type="text"
                                                class="form-control @error('fullname') is-invalid @enderror"
                                                placeholder="Masukkan nama lengkap" id="fullname" name="fullname"
                                                value="{{ old('fullname') }}">
                                            @error('fullname')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text"
                                                class="form-control @error('username') is-invalid @enderror"
                                                placeholder="Masukkan username" id="username" name="username"
                                                value="{{ old('username') }}">
                                            @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Masukkan email" id="email" name="email"
                                                value="{{ old('email') }}">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="handphone" class="form-label">Handphone</label>
                                            <input type="text"
                                                class="form-control @error('handphone') is-invalid @enderror"
                                                placeholder="Masukkan nomor handphone" id="handphone" name="handphone"
                                                value="{{ old('handphone') }}">
                                            @error('handphone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Masukkan password" id="password" name="password">
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Confirm Password</label>
                                            <input type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                placeholder="Ketik ulang password" id="password1"
                                                name="password_confirmation">
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="checkDefault" required>
                                                <label class="form-check-label text-secondary" for="checkDefault">
                                                    Accept Terms & Conditions
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <button type="submit" role="button" class="btn btn-primary w-100">Sign
                                                Up</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-center text-lg-start">

                                            Sudah punya akun? <a href="{{ route('login') }}"
                                                class="link-primary text-decoration-underline"> Sign in</a>
                                        </div>
                                    </div>
                                    <div class="app-divider-v justify-content-center">
                                        <p>Atau daftar dengan</p>
                                    </div>
                                    <div class="col-12">
                                        <a type="button" href="{{ route('google_redirect') }}"
                                            class="btn btn-gmail text-white d-inline-flex-center w-100"><i
                                                class="fa-solid fa-brands fa-google fa-fw"></i> &nbsp;Sign Up With
                                            Google </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sign up end -->
        </div>
    </div>



    <!-- latest jquery-->
    <script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>

</body>

</html>