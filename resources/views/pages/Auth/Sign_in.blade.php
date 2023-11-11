@section('title', 'Login')

@include('layout.Head')

<body class="account-page">
    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset">
                        <div class="login-logo">
                            <img src="{{ asset('Admin/assets/img/logo.png') }}" alt="img">
                        </div>
                        <div class="login-userheading">
                            <h3>login</h3>
                            <h4>Please login to your account</h4>
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
                        {{-- Login form --}}
                        <form action="{{ route('Login.post') }}" method="POST" enctype="multipart/form-data"
                            id="LoginForm">
                            @csrf
                            {{-- email --}}
                            <div class="form-login">
                                <label>email</label>
                                <div class="form-addons">
                                    <input @class([
                                        'is-invalid' => $errors->has('email'),
                                        'form-control' => true,
                                    ]) type="text" name="email"
                                        placeholder="email" required>
                                    <img src="{{ asset('Admin/assets/img/icons/mail.svg') }}" alt="img">
                                    <div class="invalid-feedback">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            {{-- password --}}
                            <div class="form-login">
                                <label>password</label>
                                <div class="pass-group">
                                    <input @class(['form-control is-invalid' => $errors->has('password')]) type="password" name="password"
                                        class="pass-input" placeholder="password" required>
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                    <div class="invalid-feedback">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="form-login">
                                <div class="alreadyuser">
                                    {{-- <h4><a href="forgetpassword.html" class="hover-a">نسيت كلمة السر؟</a></h4> --}}
                                </div>
                            </div>
                            {{-- submit button --}}
                            <div class="form-login">
                                <a id="Submit" class="btn btn-login">login</a>
                            </div>
                        </form>

                        <div class="signinform text-center">
                            <h4>Don’t have an account? <a href="{{ route('register.view') }}" class="hover-a">Sign
                                    Up</a></h4>
                        </div>
                        <div class="form-setlogin">
                            <h4>Or sign up with</h4>
                        </div>
                        <div class="form-sociallink">
                            <ul>
                                <li>
                                    <a href="{{ route('login.google') }}">
                                        <img src="assets/img/icons/google.png" class="me-2" alt="google">
                                        Sign Up using Google
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <img src="assets/img/icons/facebook.png" class="me-2" alt="google">
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
    <script src="{{ asset('Admin/assets/js/feather.min.js') }}"></script>

    <script src="{{ asset('Admin/assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('Admin/assets/js/script.js') }}"></script>
    <script src="{{ asset('Admin/assets/toasting-main/dist/js/toasting.js') }}"></script>

    <script>
        const form = document.getElementById('LoginForm');
        const submitButton = document.getElementById('Submit');

        // make submitButton submit LoginForm
        submitButton.onclick = function() {
            form.submit();
        };
    </script>
    <script src="{{ asset('Admin/assets/js/costumjs.js') }}"></script>
    <script>
        window.addEventListener('load', function() {
            @if (session('error'))
                makeTost("{{ session('error') }}", 'error', 5000);
            @endif
            @if (session('success'))
                makeTost("{{ session('success') }}", 'success', 5000);
            @endif

        });
    </script>

</body>

</html>
