<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Register</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('static/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">

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
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form action="{{ route('register.save') }}" method="POST" class="user">
                                @csrf
                                <div class="form-group">
                                    <input name="username" type="text"
                                        class="form-control uppercase form-control-user @error('username')is-invalid @enderror"
                                        id="username" placeholder="Username" value="{{ old('username') }}" required>
                                    @error('username')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input name="name" type="text"
                                        class="form-control uppercase form-control-user @error('name')is-invalid @enderror"
                                        id="exampleInputName" placeholder="Name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input name="email" type="email"
                                        class="form-control uppercase form-control-user @error('email')is-invalid @enderror"
                                        id="exampleInputEmail" placeholder="Email Address" value="{{ old('email') }}"
                                        required>
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <div class="input-group">
                                            <input name="password" type="password"
                                                class="form-control form-control-user @error('password')is-invalid @enderror"
                                                id="password"
                                                placeholder="PASSWORD (Min. 5 Characters | Max. 8 Characters | Min. 1 Uppercase & 1 Symbol)"
                                                required>
                                            <button type="button" id="togglePassword" class="btn">
                                                <i class="ri-eye-fill" id="passwordIcon"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    {{-- <div class="col-sm-6">
                                        <input name="password_confirmation" type="password"
                                            class="form-control form-control-user @error('password_confirmation')is-invalid @enderror"
                                            id="exampleRepeatPassword" placeholder="Repeat Password" required>
                                        @error('password_confirmation')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div> --}}
                                </div>
                                <button type="submit" class="btn btn-dark btn-user btn-block">Register
                                    Account</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small text-gray-800" href="{{ route('login') }}">Already have an account?
                                    Login!</a>
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

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/@flasher/flasher@latest/dist/flasher.min.js"></script>
