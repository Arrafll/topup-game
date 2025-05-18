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
  <link rel="icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/x-icon">
  <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/x-icon">

  <title>Sign In | ra-admin - Premium Admin Template</title>

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
      <!-- Body main section starts -->
      <div class="container">
        <div class="row sign-in-content-bg">
          <div class="col-lg-6 image-contentbox d-none d-lg-block">
            <div class="form-container ">
              <div class="signup-content mt-4">
                <span>
                  <img src="{{ asset('assets/images/logo/1.png') }}" alt="" class="img-fluid ">
                </span>
              </div>
             
              <div class="signup-bg-img">
                <img src="{{ asset('assets/images/login/04.png') }}" alt="" class="img-fluid">
              </div>
            </div>

          </div>
          <div class="col-lg-6 form-contentbox">
            <div class="form-container">
              <form class="app-form" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-12">
                    <div class="mb-5 text-center text-lg-start">
                      <h2 class="text-primary f-w-600">Welcome To KlikTopUp! </h2>
                      <p>Sign in with your data that you enterd during your registration</p>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="mb-3">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" class="form-control @error('username') is-invalid @enderror auth-form" name="username"  placeholder="Enter Your Username" id="username">
                        @error('username')     
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <a href="./pwd_reset.html" class="link-primary float-end">Forgot Password ?</a>
                      <input type="password" class="form-control @error('password') is-invalid @enderror auth-form" name="password" placeholder="Enter Your Password" id="password">
                        @error('password')     
                          <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-check mb-3">
                      <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                      <label class="form-check-label text-secondary" for="checkDefault">
                        Remember me
                      </label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="mb-3">
                      <button role="button" class="btn btn-primary w-100" type="submit">Sign In</a>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="text-center text-lg-start">
                      Don't Have Your Account yet? <a href="./sign_up.html"
                        class="link-primary text-decoration-underline"> Sign up</a>
                    </div>
                  </div>
                  <div class="app-divider-v justify-content-center">
                    <p>Or sign in with</p>
                  </div>
                  <div class="col-12">
                      <a type="button" href="{{ route('google_redirect') }}" class="btn btn-gmail text-white d-inline-flex-center w-100"><i class="fa-solid fa-brands fa-google fa-fw"></i> &nbsp;Sign In With Google </a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Body main section ends -->
    </div>
  </div>
  <!-- latest jquery-->
  <script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>

  <!-- Bootstrap js-->
  <script src="{{ asset('assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
</body>

</html>

<script>
  $('.auth-form').each(function(){
    $(this).on('keyup', function(){
        $(this).removeClass('is-invalid');
        $(this).next('invalid-feedback').hide();
    });
  });
</script>