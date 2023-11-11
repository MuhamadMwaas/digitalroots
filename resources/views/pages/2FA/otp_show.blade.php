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

                        <div class="container">
                            <form method="POST" action="{{ route('otp.post') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="otp" class="col-sm-4 col-form-label text-md-right">
                                        OTP
                                    </label>

                                    <div class="col-md-6">
                                        <input id="otp" type="number" min="0" max="999999"
                                            step="1"
                                            class="form-control{{ $errors->has('one_time_password') ? ' is-invalid' : '' }}"
                                            autocomplete="off" name="one_time_password" value="" required autofocus>

                                        @if ($errors->has('one_time_password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('one_time_password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
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
