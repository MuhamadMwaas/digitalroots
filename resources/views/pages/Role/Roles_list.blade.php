@extends('layout.Main_Layout')
@section('title', 'Roles list')


@section('Main_Content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>List of roler</h4>

                </div>
                @can('role-create')
                    <div class="page-btn">
                        <a href="{{ route('roles.create') }}" class="btn btn-added"><img
                                src="{{ asset('Admin/assets/img/icons/plus.svg') }}" alt="img" class="me-1">Create new
                            role</a>
                    </div>
                @endcan
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
                                    <th>No</th>
                                    <th>name</th>
                                    <th>Action</th>
                                    <th>created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>
                                            {{ $role->id }}

                                        </td>
                                        <td>{{ $role->name }}</td>



                                        <td>
                                            <a class="btn btn-info" href="{{ route('roles.show', $role->id) }}">Show</a>

                                            @can('role-edit')
                                                <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                                            @endcan

                                            @can('role-delete')
                                                <form id="deleteRole{{ $role->id }}" class="d-inline"
                                                    action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="id" value="{{ $role->id }}">
                                                    <a class="" href="javascript:void(0);"
                                                        onclick="deleteRole({{ $role->id }},'{{ $role->name }}')">
                                                        <img src="{{ asset('Admin/assets/img/icons/delete.svg') }}"
                                                            alt="delet image">
                                                    </a>
                                                </form>
                                            @endcan

                                        </td>
                                        <td>{{ $role->created_at }}</td>
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
        function deleteRole(id, name) {
            Swal.fire({
                title: `confirem delete role`,
                html: `The role  <strong><span class="text-danger">${name}</span> will be deleted</strong>`,
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'yes',
                cancelButtonText: 'no'
            }).then((result) => {
                if (result.isConfirmed) {

                    document.getElementById('deleteRole' + id).submit();
                }
            });
        }
    </script>
@endpush
