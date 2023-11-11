@extends('layout.Main_Layout')
@section('title', 'Edite ')


@section('Main_Content')

    <div class="page-wrapper cardhead">
        {{-- contaner start --}}
        <div class="content container-fluid">
            {{-- herder page --}}
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Edite user {{ $user->name }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('Dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('Admin.Users.list') }}">User List</a></li>

                            <li class="breadcrumb-item active"> Edite user {{ $user->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        {{-- header card --}}
                        <div class="card-header">
                            <h5 class="card-title">User Edite</h5>
                        </div>
                        <div class="card-body">
                            {{-- start form --}}
                            <form action="{{ route('Admin.update.put', $user->id) }}" class="" id="new_user"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                {{-- الاسم --}}
                                <div class="form-group row">
                                    <label class="col-form-label col-md-1">name</label>
                                    <div class="col-md-11">
                                        <input value="{{ old('name', $user->name) }}" id="validationTooltip03"
                                            type="text" @class(['is-invalid' => $errors->has('name'), 'form-control' => true]) name="name" required>
                                        <div class="invalid-feedback">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- الايميل --}}
                                <div class="form-group row">
                                    <label class="col-form-label col-md-1">email</label>
                                    <div class="col-md-11">
                                        <input value="{{ old('email', $user->email) }}"
                                            type="email"@class([
                                                'is-invalid' => $errors->has('email'),
                                                'form-control' => true,
                                            ]) name="email" required>
                                        <div class="invalid-feedback">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- كلمة المرور --}}
                                <div class="form-group row">
                                    <label class="col-form-label col-md-1">New password</label>
                                    <div class="col-md-11">
                                        <input type="password" @class([
                                            'is-invalid' => $errors->has('password'),
                                            'form-control' => true,
                                        ]) min="6" name="password">
                                        <div class="invalid-feedback">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- إعادة كلمة المرور --}}
                                <div class="form-group row">
                                    <label class="col-form-label col-md-1">confirm password</label>
                                    <div class="col-md-11">
                                        <input type="Password" @class([
                                            'is-invalid' => $errors->has('password'),
                                            'form-control' => true,
                                        ]) min="6"
                                            name="password_confirmation">

                                    </div>
                                </div>
                                {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control', 'multiple']) !!}

                                {{-- صورة المستخدم --}}
                                <div class="form-group">
                                    <label>User Image</label>
                                    <div class="image-upload">
                                        <input id="Image_input" type="file" @class(['is-invalid' => $errors->has('name'), 'form-control' => true]) name="image"
                                            accept='.jpg ,.png ,.jpeg ,.svg'>
                                        <div class="invalid-feedback">
                                            @error('image')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="image-uploads">
                                            <img src="{{ asset('Admin/assets/img/icons/upload.svg') }}" alt="img">
                                            <h4>Upload new User Image</h4>
                                        </div>



                                        <div class="row justify-content-center" id="imagePreviewContainer"
                                            style="@if ($user->image == null) display: none; @endif">
                                            <div class=" text-center">
                                                <img style="width: 800px; height: 600px;" id="imagePreview"
                                                    src="{{ asset('images/Admins/' . $user->id . '/' . $user->image) }}"
                                                    alt="Image Preview">
                                                <br>
                                                <button class="btn btn-danger" type="button" id="removeImageButton"
                                                    onclick="removeImage()">Remove
                                                    Image</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- زر الإضافة --}}
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-primary" type="submit"> Update</button>
                                </div>
                                <input id="new_Image" type="hidden" name="new_Image" value="f">
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- contaner end --}}
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('#new_user');
            const password = form.querySelector('input[name="password"]');
            const confirmPassword = form.querySelector('input[name="password_confirmation"]');
            const invalidFeedback = form.querySelector('.invalid-feedback');


            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const email = form.querySelector('input[name="email"]').value;
                const name = form.querySelector('input[name="name"]').value;
                // عرض رسالة SweetAlert قبل الإرسال
                Swal.fire({
                    title: 'submit Update',
                    html: `
                    <div>User Name: <b>[ ${name} ]</b><br> email :  <b>[ ${email} ]</b><br> Password:  <b>[ ${password.value} ]</b><br> 
                </div>`,
                    text: 'confirm the edite',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'yes',
                    cancelButtonText: 'no',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif
    </script>
    <script>
        const imageInput = document.getElementById('Image_input');
        const new_Image = document.getElementById('new_Image');
        const imagePreview = document.getElementById('imagePreview');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        const removeImageButton = document.getElementById('removeImageButton');

        imageInput.addEventListener('change', function() {
            new_Image.value = 't';
            const file = imageInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    imagePreview.src = event.target.result;
                };
                reader.readAsDataURL(file);
                imagePreviewContainer.style.display = 'block';
            } else {
                imagePreview.src = '#';
                imagePreviewContainer.style.display = 'none';
            }
        });

        function removeImage() {
            new_Image.value = 't';
            imageInput.value = '';
            imagePreview.src = '#';
            imagePreviewContainer.style.display = 'none';
        }
    </script>
@endpush
