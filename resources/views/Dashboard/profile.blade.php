@extends('layout.Main_Layout')
@section('title', $admin->name . ' profile')


@section('Main_Content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Admin Profile</h4>


                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form autocomplete="off" enctype="multipart/form-data" action="{{ route('Admin.UpdateProfile.post') }}"
                        method="POST" id="updateAdmin">
                        @csrf
                        <div class="profile-set">
                            <div class="profile-head">
                            </div>
                            <div class="profile-top">
                                <div class="profile-content">
                                    <div class="profile-contentimg">

                                        <img src="@if ($admin->image != 'null' && $admin->image != null) {{ asset('images/Admins/' . $admin->id . '/' . $admin->image) }} @else {{ asset('Admin/assets/img/duser.svg') }} @endif"
                                            alt="img" id="blah">
                                        <div class="profileupload">
                                            <input type="file" name="image" id="imgInp">
                                            <a href="javascript:void(0);"><img
                                                    src="{{ asset('Admin/assets/img/icons/edit-set.svg') }}"
                                                    alt="img"></a>
                                        </div>
                                    </div>
                                    <div class="profile-contentname">
                                        <h2>{{ $admin->name }} @if ($admin->is_super)
                                                <img style="height: 20px; width: 20px"
                                                    src="{{ asset('Admin/assets/img/icons/super.svg') }}">
                                            @endif
                                        </h2>
                                        <h4>Update your personal data</h4>
                                    </div>
                                </div>
                                <div class="ms-auto">
                                    <button type="button" onclick="removeImage()" class="btn btn-submit me-2">remove
                                        image</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>name</label>
                                    <input type="text" name="name" placeholder="" value="{{ $admin->name }}" required
                                        @class([
                                            'is-invalid' => $errors->has('name'),
                                            'form-control' => true,
                                            'pass-input' => true,
                                        ])>
                                    <div class="invalid-feedback">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                </div>

                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>email</label>
                                    <input type="text" name="email" placeholder="" value="{{ $admin->email }}" required
                                        @class([
                                            'is-invalid' => $errors->has('email'),
                                            'form-control' => true,
                                            'pass-input' => true,
                                        ])>
                                    <div class="invalid-feedback">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-12 col-sm-12">
                                <div class="form-group">
                                    <label>current Password</label>
                                    <div class="pass-group">
                                        <input type="password" name="current_Password" @class([
                                            'is-invalid' => $errors->has('current_Password'),
                                            'form-control' => true,
                                            'pass-input' => true,
                                        ])
                                            role="presentation" autocomplete="off">
                                        <span
                                            class="fas
                                            toggle-password fa-eye-slash"></span>
                                        <div class="invalid-feedback">
                                            @error('current_Password')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>password</label>
                                    <div class="pass-group">
                                        <input autocomplete="off" type="password" name="password"
                                            @class([
                                                'is-invalid' => $errors->has('password'),
                                                'form-control' => true,
                                                'pass-input' => true,
                                            ])>
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                        <div class="invalid-feedback">
                                            @error('password')
                                                passwords not matches
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>confirm password</label>
                                    <div class="pass-group">
                                        <input type="password" name="password_confirmation" class=" pass-input">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button href="" type="submit" class="btn btn-submit me-2">save</button>
                                <a href="javascript:void(0);" class="btn btn-cancel">cancel</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
@push('script')
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @isset($success)
            toastr.success("{{ $success }}");
        @endisset
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            //get form
            const form = document.querySelector('#updateAdmin');

            form.addEventListener('submit', (e) => {
                var password = form.querySelector('input[name="password"]');
                var confirmPassword = form.querySelector('input[name="password_confirmation"]');
                e.preventDefault();

                if (password.value != confirmPassword.value) {

                    makeTost('The two passwords do not match', 'error');
                } else {
                    const email = form.querySelector('input[name="email"]').value;
                    const name = form.querySelector('input[name="name"]').value;

                    //popup confirm window
                    Swal.fire({
                        title: 'Confirm data modification',
                        html: `
                <div>user name : <b>[ ${name} ]</b><br> email :  <b>[ ${email} ]</b><br> </b><br> password :  <b>[ ${password.value} ]</b><br> 
            </div>`,
                        text: 'Are you sure you are making modifications?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'update',
                        cancelButtonText: 'cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }

            });


        });
    </script>

    <script>
        function removeImage() {
            sendRequest("{{ route('Admin.RemoveImage') }}");
            var image = document.getElementById("blah");
            image.src = "{{ asset('Admin/assets/img/duser.svg') }}";

        }


        function refresh2() {
            window.location.href = window.location.href;
        }
    </script>
@endpush
