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
                        <div class="card">
                            <div class="card-header">2-factors authentication</div>

                            <div class="card-body">
                                <p>
                                    2-factors authentication is currently
                                    <span class='badge bg-warning'>disabled</span>. To enable:
                                </p>

                                <ol class="list-left-align">
                                    <li>Open your OTP app and <b>scan the following QR-code</b>
                                        <p class="text-center">

                                            {!! $qr_code !!}
                                        </p>
                                    </li>

                                    <li>Generate a One Time Password (OTP) and enter the value below.

                                        <form action="{{ route('2far.post') }}" method="POST"
                                            class="form-inline text-center">
                                            <input type="hidden" name="sec" value="{{ $secret }}">

                                            @csrf
                                            <input name="otp"
                                                class="form-control mr-1{{ $errors->has('otp') ? ' is-invalid' : '' }}"
                                                type="number" min="0" max="999999" step="1" required
                                                autocomplete="off">
                                            <button type="submit"
                                                class="form-control btn-sm btn-primary">Submit</button>
                                            @if ($errors->has('otp'))
                                                <span class="invalid-feedback text-left">
                                                    <strong>{{ $errors->first('otp') }}</strong>
                                                </span>
                                            @endif
                                        </form>
                                    </li>
                                </ol>

                            </div>
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
