@extends('layout.Main_Layout')
@section('title', 'role ' . $role->name)


@section('Main_Content')

    <div class="page-wrapper cardhead">
        {{-- contaner start --}}
        <div class="content container-fluid">
            {{-- herder page --}}
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">show role {{ $role->name }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('Dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">roles List</a></li>

                            <li class="breadcrumb-item active"> show role {{ $role->name }}</li>
                        </ul>
                    </div>

                </div>
                <div class="page-btn">
                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-added">Edit</a>
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


                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $role->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permissions:</strong><br>
                        @if (!empty($rolePermissions))
                            @foreach ($rolePermissions as $v)
                                <span style="font-size: small; margin-top: 10px"
                                    class="badge bg-info text-dark">{{ $v->name }},</span><br>
                            @endforeach
                        @endif
                    </div>
                    <br>
                    <div class="form-group">
                        <strong>Users use this role:</strong><br>
                        @if (!empty($users))
                            @foreach ($users as $user)
                                <a href="{{ route('Admin.User.show', $user->id) }}"
                                    style="font-size: small; margin-top: 10px"
                                    class="badge bg-success text-dark">{{ $user->name }}</a><br>
                            @endforeach
                        @endif
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
