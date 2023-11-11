{{-- SideBar Sart --}}
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="@if ($route == 'Dashboard.index') active @endif">
                    <a href="{{ route('Dashboard.index') }}"><img
                            src="{{ asset('Admin/assets/img/icons/dashboard.svg') }}"
                            alt="img"><span>Dashboard</span> </a>
                </li>

                <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{ asset('Admin/assets/img/icons/users.svg') }}"
                            alt="img"
                            class="{{ $prefix == 'admin/users' ? 'active subdrop' : '' }}"><span>Users</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        @can('users-list')
                            <li><a class="@if ($route == 'Admin.Users.list') active @endif"
                                    href="{{ route('Admin.Users.list') }}">User List</a></li>
                        @endcan

                        @can('role-list')
                            <li><a class="@if ($route == 'roles.index') active @endif"
                                    href="{{ route('roles.index') }}">roles</a></li>
                        @endcan

                    </ul>
                </li>






            </ul>
        </div>
    </div>
</div>
{{-- SideBar END --}}
