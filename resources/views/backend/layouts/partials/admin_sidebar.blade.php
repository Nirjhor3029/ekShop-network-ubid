@php
$usr = Auth::guard('admin')->user();
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ $themePath }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">ekShop Network </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ $themePath }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
                {{-- <span id="current_balance">22.24 <b>৳</b></span> --}}

            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->


                {{-- @if ($usr->can('dashboard.view'))
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                @endif --}}



                <li class="nav-item menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Business Listings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.business_listings') }}"
                                class="nav-link {{ Route::is('admin.business_listings') ? 'active' : '' }}">
                                <i class="far fas fa-angle-right nav-icon"></i>
                                <p>New Entry</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.business_listings.all') }}"
                                class="nav-link {{ Route::is('admin.business_listings.all') ? 'active' : '' }}">
                                <i class="far fas fa-angle-right nav-icon"></i>
                                <p>All Entries</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.business_listings.import') }}"
                                class="nav-link {{ Route::is('admin.business_listings.import') ? 'active' : '' }}">
                                <i class="far fas fa-angle-right nav-icon"></i>
                                <p>import Entries</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Roles & Permissions --}}
                {{-- @if ($usr->can('role.create') || $usr->can('role.view') || $usr->can('role.edit') || $usr->can('role.delete'))
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-industry"></i>
                            <p>
                                Roles & Permissions
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if ($usr->can('role.view'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.index') }}" class="nav-link">
                                        <i class="far fas fa-angle-right nav-icon"></i>
                                        <p>All Role</p>
                                    </a>
                                </li>
                            @endif
                            @if ($usr->can('role.create'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.create') }}" class="nav-link">
                                        <i class="far fas fa-angle-right nav-icon"></i>
                                        <p>Create Role</p>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif --}}

                {{-- Admins --}}
                {{-- @if ($usr->can('admin.create') || $usr->can('admin.view') || $usr->can('admin.edit') || $usr->can('admin.delete'))
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-industry"></i>
                            <p>
                                Admins
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if ($usr->can('admin.view'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.admins.index') }}" class="nav-link">
                                        <i class="far fas fa-angle-right nav-icon"></i>
                                        <p>All Admins</p>
                                    </a>
                                </li>
                            @endif
                            @if ($usr->can('admin.create'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.admins.create') }}" class="nav-link">
                                        <i class="far fas fa-angle-right nav-icon"></i>
                                        <p>Create Admin</p>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif --}}


                {{-- menu-open --}}
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-industry"></i>
                        <p>
                            Companies
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.company.all') }}" class="nav-link">
                                <i class="far fas fa-angle-right nav-icon"></i>
                                <p>All Company List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.company.create') }}" class="nav-link">
                                <i class="far fas fa-angle-right nav-icon"></i>
                                <p>Create Company</p>
                            </a>
                        </li>

                    </ul>
                </li> --}}


                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon 	fas fa-address-book"></i>
                        <p>
                            Phone Book
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html" class="nav-link">
                                <i class="far fas fa-angle-right nav-icon"></i>
                                <p>Contacts & Groups</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="nav-header">Extra</li>
                    <li class="nav-item">
                        <a href="pages/calendar.html" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Statements
                                <span class="badge badge-info right">2</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/calendar.html" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Campaign Report
                                <span class="badge badge-info right">2</span>
                            </p>
                        </a>
                    </li> --}}

                @if (Session::get('isSuperAdmin', 0))
                    <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Only Super Admin
                            </p>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
