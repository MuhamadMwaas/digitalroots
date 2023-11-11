@extends('layout.Main_Layout')
@section('title', 'User Management')


@section('Main_Content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>User data<span class="text-info">{{ $user->name }}</span></h4>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.Users.list') }}">User List</a></li>
                        <li class="breadcrumb-item active">User data {{ $user->name }}</li>
                    </ul>
                </div>

            </div>


            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="productdetails">
                                <ul class="product-bar">
                                    <li>
                                        <h4>name</h4>
                                        <h6>{{ $user->name }}</h6>
                                    </li>
                                    <li>
                                        <h4>email</h4>
                                        <h6>{{ $user->email }}</h6>
                                    </li>
                                    <li>
                                        <h4>emil status</h4>
                                        <h6>{{ $user->verify_status }}</h6>
                                    </li>
                                    <li>
                                        <h4>created at</h4>
                                        <h6>{{ date('Y-m-d - H:i', strtotime($user->created_at)) }}</h6>
                                    </li>
                                    <li>
                                        <h4>updated at</h4>
                                        <h6>{{ date('Y-m-d - H:i', strtotime($user->updated_at)) }}</h6>
                                    </li>

                                </ul>
                                @can('users-active-account')


                                    @if ($user->is_active)
                                        <form id="Deactivate" class="d-inline" action="{{ route('Admin.Deactivate.post') }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <button type="button" onclick="Deactivatef('{{ $user->name }}')"
                                                class="btn btn-danger mt-4">Deactivate account</button>

                                        </form>
                                    @else
                                        <form id="activeAccount" class="d-inline" action="{{ route('Admin.active.post') }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <button type="button" onclick="activeAccount('{{ $user->name }}')"
                                                class="btn btn-success mt-4">activate account</button>

                                        </form>
                                    @endif
                                @endcan
                                @can('clear2fa')
                                    <form id="reset2fa" class="d-inline" action="{{ route('Admin.clear2fa.post') }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <button type="button" onclick="reset2fa('{{ $user->name }}')"
                                            class="btn btn-danger mt-4">2FA reset</button>

                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="slider-product-details">
                                <div class="owl-carousel owl-theme">
                                    <div class="slider-product">
                                        @if ($user->image == null)
                                            <img src="{{ asset('Admin/assets/img/duser.svg') }}" alt="img">
                                        @else
                                            <img src="{{ asset('images/Admins/' . $user->id . '/' . $user->image) }}"
                                                alt="img">
                                        @endif
                                        @if ($user->image)
                                            <h4>{{ $user->image }}</h4>
                                            <h6>{{ $image_size }}kb</h6>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>

@endsection

@push('script')
    <script>
        function Deactivatef(name) {
            Swal.fire({
                title: `Deactivate account &nbsp; <strong class="text-danger"> ${name}</strong>؟`,
                text: "Admin can not login ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Agree',
                cancelButtonText: 'cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('Deactivate').submit();
                }
            });
        }

        function activeAccount(name) {
            Swal.fire({
                title: `active account &nbsp; <strong class="text-danger">${name}</strong>؟`,
                text: "Admin will be able to login",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Agree',
                cancelButtonText: 'cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('activeAccount').submit();
                }
            });
        }

        function reset2fa(name) {
            Swal.fire({
                title: `confirem 2FA rest`,
                text: "User 2FA setting will be null",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Agree',
                cancelButtonText: 'cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('reset2fa').submit();
                }
            });
        }
    </script>
@endpush
