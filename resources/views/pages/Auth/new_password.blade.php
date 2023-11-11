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
                            <h3>CreateNewPassword</h3>
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
                        <form action="{{ route('new_password.post') }}" method="POST" enctype="multipart/form-data"
                            id="RegisterForm">
                            @csrf

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
                                <a class="btn btn-login" id="Sign_Up">create new password</a>
                            </div>
                        </form>


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
