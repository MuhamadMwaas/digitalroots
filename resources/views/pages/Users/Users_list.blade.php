@extends('layout.Main_Layout')
@section('title', 'User Management')


@section('Main_Content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>List of users</h4>
                    <h6>Manage your users</h6>

                </div>
                <div class="page-btn">

                </div>
            </div>
            {{-- card of table --}}
            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            {{-- search --}}
                            <div class="search-path">
                                <a class="btn btn-filter" id="filter_search">
                                    <img src="{{ asset('Admin/assets/img/icons/filter.svg') }}" alt="img">
                                    <span><img src="{{ asset('Admin/assets/img/icons/closes.svg') }}" alt="img"></span>
                                </a>
                            </div>
                            <div class="search-input">
                                <a class="btn btn-searchset"><img
                                        src="{{ asset('Admin/assets/img/icons/search-white.svg') }}" alt="img"></a>
                            </div>
                        </div>
                        <div class="wordset">

                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table  datanew">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>name</th>
                                    <th>email</th>
                                    <th>EMAIL status</th>
                                    <th>create date</th>
                                    <th>acount status</th>
                                    <th>roles</th>
                                    <th>last seen</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            {{ $user->id }}

                                        </td>
                                        <td class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img style=" border-radius: 50%"
                                                    src=" @if ($user->image == null) {{ asset('Admin/assets/img/duser.svg') }} @else {{ asset('images/Admins/' . $user->id . '/' . $user->image) }} @endif "
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">{{ $user->name }}</a>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->verify_status }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            @if ($user->is_active)
                                                <a class="badge rounded-pill bg-success">active</a>
                                            @else
                                                <a class="badge rounded-pill bg-danger">inactive</a>
                                            @endif

                                        </td>
                                        <td>
                                            @foreach ($user->roles as $userrole)
                                                <span style="font-size: small"
                                                    class="badge bg-info text-dark">{{ $userrole->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($user->lastseen())
                                                {{ $user->lastseen()->lastseen }}
                                            @else
                                                --
                                            @endif
                                        </td>
                                        <td>
                                            <a class="me-3" href="{{ route('Admin.User.show', $user->id) }}">
                                                <img src="{{ asset('Admin/assets/img/icons/eye.svg') }}" alt="img">
                                            </a>
                                            @can('users-edit')
                                                <a class="me-3" href="{{ route('Admin.edite.show', $user->id) }}">
                                                    <img src="{{ asset('Admin/assets/img/icons/edit.svg') }}" alt="img">
                                                </a>
                                            @endcan

                                            @can('users-delete')
                                                <form id="Delete_user{{ $user->id }}" class="d-inline"
                                                    action="{{ route('Admin.delete.post') }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                                    <a class="" href="javascript:void(0);"
                                                        onclick="deleteform({{ $user->id }},'{{ $user->name }}')">
                                                        <img src="{{ asset('Admin/assets/img/icons/delete.svg') }}"
                                                            alt="delet image">
                                                    </a>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- END card of table --}}

        </div>
    </div>

@endsection

@push('script')
    <script>
        function deleteform(id, name) {
            Swal.fire({
                title: `Do you want to delete the account`,
                html: `The account <br> <strong><span class="text-danger">${name}</span> will be deleted</strong>`,
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'yes',
                cancelButtonText: 'no'
            }).then((result) => {
                if (result.isConfirmed) {
                    // إذا تم النقر على زر "نعم، احذفه!"، استدعاء دالة submit() للنموذج
                    document.getElementById('Delete_user' + id).submit();
                }
            });
        }
    </script>
@endpush
