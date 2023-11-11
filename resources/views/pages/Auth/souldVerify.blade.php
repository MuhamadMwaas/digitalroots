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
                            <h4>we send verfiy link to your email</h4>
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
                        @if (session('error'))
                            <div class="alert alert-danger">
                                <ul>
                                    {{ session('error') }}
                                </ul>
                            </div>
                        @endif
                        {{-- Login form --}}
                        <form action="{{ route('resendVerify.post') }}" method="POST" enctype="multipart/form-data"
                            id="form">
                            @csrf

                            {{-- submit button --}}
                            <div class="form-login">
                                <a id="Submit" class="btn btn-login">resend the email</a>
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
    <script src="{{ asset('Admin/assets/js/feather.min.js') }}"></script>

    <script src="{{ asset('Admin/assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('Admin/assets/js/script.js') }}"></script>
    <script src="{{ asset('Admin/assets/toasting-main/dist/js/toasting.js') }}"></script>

    <script>
        const form = document.getElementById('form');
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
