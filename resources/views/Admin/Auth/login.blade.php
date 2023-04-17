<!doctype html>

<html lang="en">







<head>



    <meta charset="utf-8" />

    <title>Admin | Caramia</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <!-- App favicon -->

    <link rel="shortcut icon" href="{{ asset('user-asset/assets/images/favicon.png') }}">



    <!-- Bootstrap Css -->

    <link href="{{ asset('admin-asset/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />

    <!-- Icons Css -->

    <link href="{{ asset('admin-asset/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App Css-->

    <link href="{{ asset('admin-asset/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />


    <style>
        .password-input{
            position: relative;
        }

        .password-icon{
            position: absolute;
    top: 50%;
    right: 31px;
        }
    </style>

</head>



<body class="authentication-bg d-flex align-items-center min-vh-100 py-5">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <div class="text-center">

                    <a href="#" class="d-block auth-logo">

                        <img src="{{ asset('admin-asset/assets/images/logo.png') }}" alt="" height="40"
                            class="logo logo-dark mx-auto">

                        <img src="{{ asset('admin-asset/assets/images/logo.png') }}" alt="" height="24"
                            class="logo logo-light mx-auto">

                    </a>

                </div>

            </div>

        </div>

        <div class="row justify-content-center">

            <div class="col-md-8 col-lg-6 col-xl-5">

                <div class="p-4">

                    <div class="card overflow-hidden mt-2">

                        <div class="auth-logo text-center bg-primary position-relative">

                            <div class="img-overlay"></div>

                            <div class="position-relative pt-4 py-5 mb-1">



                                <p class="text-white-50 mb-0">Sign in to Admin Panel</p>

                            </div>

                        </div>

                        <div class="card-body position-relative">

                            <div class="p-4 mt-n5 card rounded">

                                {{-- @if (Session::has('msg'))
                                    <p class="alert alert-danger">{{ Session::get('msg') }}</p>
                                @endif --}}

                                <form class="form-horizontal" method="post" action="{{ route('admin.login') }}">

                                    @csrf

                                    <div class="mb-3">

                                        <label for="email" class="form-label">Email</label>

                                        <input type="email" class="form-control" id="username"
                                            placeholder="Enter Email" name="email">

                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif

                                    </div>



                                    <div class="mb-3">

                                        <label for="userpassword">Password</label>

                                        {{-- <input type="password" name="password" class="form-control" id="userpassword"
                                            placeholder="Enter password">
                                        <div>
                                            <input type="checkbox" onclick="myFunction()" class="ml-2">Show Password
                                        </div> --}}

                                        <input name="password" type="password" value="" class="input form-control password-input" id="userpassword" placeholder="password" required="true" aria-label="password" aria-describedby="basic-addon1" />
                                        <span class="password-icon" onclick="password_show_hide();">
                                            <i class="fas fa-eye" id="show_eye"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                        </span>
                                            {{-- <div class="input-group-append">
                                                <span class="input-group-text" onclick="password_show_hide();">
                                                <i class="fas fa-eye" id="show_eye"></i>
                                                <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                                </span>
                                            </div> --}}
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif

                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>







                                    <div class="mt-3">

                                        <button class="btn btn-primary w-100 waves-effect waves-light"
                                            type="submit">Log IN</button>

                                    </div>



                                   

                                </form>

                            </div>

                        </div>

                    </div>





                </div>

            </div>

        </div>



    </div>



    <!-- JAVASCRIPT -->

    <script src="{{ asset('admin-asset/assets/libs/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('admin-asset/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('admin-asset/assets/libs/metismenu/metisMenu.min.js') }}"></script>

    <script src="{{ asset('admin-asset/assets/libs/simplebar/simplebar.min.js') }}"></script>

    <script src="{{ asset('admin-asset/assets/libs/node-waves/waves.min.js') }}"></script>



    <script src="{{ asset('admin-asset/assets/js/app.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
//     function myFunction() {
//   var x = document.getElementById("userpassword");
//   if (x.type === "password") {
//     x.type = "text";
//   } else {
//     x.type = "password";
//   }
// }

function password_show_hide() {
  var x = document.getElementById("userpassword");
  var show_eye = document.getElementById("show_eye");
  var hide_eye = document.getElementById("hide_eye");
  hide_eye.classList.remove("d-none");
  if (x.type === "password") {
    x.type = "text";
    show_eye.style.display = "none";
    hide_eye.style.display = "block";
  } else {
    x.type = "password";
    show_eye.style.display = "block";
    hide_eye.style.display = "none";
  }
}
</script>
<script>
    @if($msg = session('msg'))
    swal("{{ $msg }}");
    @endif
    </script>
</body>





</html>
