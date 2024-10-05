<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('static/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('static/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .uppercase {
            text-transform: uppercase;
        }
    </style>
</head>

<body class="bg-white">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="row align-items-center justify-content-center mt-5">
                    <a href="https://phiraka.com/" target="_blank" rel="noopener noreferrer">
                        <div class="sidebar-brand-icon">
                            <img src="{{ asset('images/logo.png') }}" alt="logo" width="30px">
                        </div>
                    </a>
                </div>

                <div class="card o-hidden border-0 shadow-lg my-5">

                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Laravel App</h1>
                                    </div>
                                    <form action="{{ route('login.action') }}" method="POST" class="user"
                                        id="loginUser">
                                        @csrf
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <label for="name">Email or Username</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input name="name" type="name"
                                                    class="form-control form-control-user uppercase" id="name"
                                                    aria-describedby="name" required>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-md-3">
                                                <label for="name">Password</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <input name="password" type="password"
                                                        class="form-control form-control-user" id="password"required>
                                                    <button type="button" id="togglePassword" class="btn">
                                                        <i class="ri-eye-fill" id="passwordIcon"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Google reCAPTCHA -->
                                        <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <label for="captcha">Captcha</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="captcha">
                                                        <span>{!! captcha_img('captcha.default.length') !!}
                                                        </span>
                                                        <button type="button" class="btn btn-success btn-refresh"><i
                                                                class="fa mt-1 ri-restart-line"></i></button>
                                                    </div>
                                                    <input id="captcha" type="text"
                                                        class="form-control-user form-control-user mt-2 form-control"
                                                        placeholder="Enter Captcha" name="captcha">
                                                    @if ($errors->has('captcha'))
                                                        <span class="help-block text-danger">
                                                            <strong>{{ $errors->first('captcha') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-dark btn-block btn-user">Login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small text-gray-800" href="{{ route('register') }}">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('static/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('static/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('static/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('static/js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const passwordIcon = document.querySelector('#passwordIcon');

        togglePassword.addEventListener('click', function(e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            if (type === 'password') {
                passwordIcon.classList.remove('ri-eye-fill');
                passwordIcon.classList.add('ri-eye-off-fill');
            } else {
                passwordIcon.classList.remove('ri-eye-off-fill');
                passwordIcon.classList.add('ri-eye-fill');
            }
        });
    </script>
    <script type="text/javascript">
        $(".btn-refresh").click(function() {
            $.ajax({
                type: 'GET',
                url: "{{ route('refresh.captcha') }}",
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>
    @if (session('swal_error'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: "{{ session('swal_error') }}",
                showConfirmButton: true,
                timer: 3000
            });
        </script>
    @endif
</body>

</html>
