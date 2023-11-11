@section('title', 'Create an Account')

@include('layout.Head')

<body class="account-page">

    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset">
                        <div class="login-logo">
                            <img src="assets/img/logo.png" alt="img">
                        </div>
                        <div class="login-userheading">
                            <h3>Create an Account</h3>
                            <h4>Continue where you left off</h4>
                        </div>
                        @if ($errors->has('error_in_login'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- Register Form --}}
                        <form action="{{ route('register.post') }}" method="POST" enctype="multipart/form-data"
                            id="RegisterForm">
                            @csrf
                            {{-- name --}}
                            <div class="form-login">
                                <label>Full Name</label>
                                <div class="form-addons">
                                    <input name="name" @class([
                                        'is-invalid' => $errors->has('name'),
                                        'form-control' => true,
                                    ]) type="text"
                                        placeholder="Enter your full name">
                                    <img src="{{ asset('Admin/assets/img/icons/users1.svg') }}" alt="img">
                                    <div class="invalid-feedback">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Email --}}
                            <div class="form-login">
                                <label>Email</label>
                                <div class="form-addons">
                                    <input name="email" @class([
                                        'is-invalid' => $errors->has('email'),
                                        'form-control' => true,
                                    ]) type="text"
                                        placeholder="Enter your email address">
                                    <img src="{{ asset('Admin/assets/img/icons/mail.svg') }}" alt="img">
                                    <div class="invalid-feedback">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Password --}}
                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input name="password" @class([
                                        'is-invalid' => $errors->has('password'),
                                        'form-control' => true,
                                        'pass-input' => true,
                                    ]) type="password"
                                        placeholder="Enter your password">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                    <div class="invalid-feedback">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Password confirmation --}}
                            <div class="form-login">
                                <label>Password confirmation</label>
                                <div class="pass-group">
                                    <input name="password_confirmation" @class([
                                        'is-invalid' => $errors->has('password_confirmation'),
                                        'form-control' => true,
                                        'pass-input' => true,
                                    ]) type="password"
                                        placeholder="Re-enter the password">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                    <div class="invalid-feedback">
                                        @error('password_confirmation')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- submit button --}}
                            <div class="form-login">
                                <a class="btn btn-login" id="Sign_Up">Sign Up</a>
                            </div>
                        </form>
                        <div class="signinform text-center">
                            <h4>Already a user? <a href="{{ route('Login.view') }}" class="hover-a">Sign In</a></h4>
                        </div>
                        <div class="form-setlogin">
                            <h4>Or sign up with</h4>
                        </div>
                        {{-- social --}}
                        <div class="form-sociallink">
                            <ul>
                                <li>
                                    <a href="{{ route('login.google') }}">
                                        <img src="{{ asset('Admin/assets/img/icons/google.png') }}" class="me-2"
                                            alt="google">
                                        Sign Up using Google
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <img src="{{ asset('Admin/assets/img/icons/facebook.png') }}" class="me-2"
                                            alt="google">
                                        Sign Up using Facebook
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="login-img">
                    <img src="{{ asset('Admin/assets/img/login.jpg') }}" alt="img">
                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('Admin/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('Admin/assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('Admin/assets/plugins/toastr/toastr.js') }}"></script>
    <script src="{{ asset('Admin/assets/js/feather.min.js') }}"></script>

    <script src="{{ asset('Admin/assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('Admin/assets/js/script.js') }}"></script>
    <script>
        const form = document.getElementById('RegisterForm');
        const submitButton = document.getElementById('Sign_Up');

        // make submitButton submit LoginForm
        submitButton.onclick = function() {
            form.submit();
        };
    </script>

</body>

</html>
