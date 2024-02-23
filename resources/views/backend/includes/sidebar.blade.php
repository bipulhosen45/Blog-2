<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset(Auth::user()->image) }}" class="img-circle elevation-2 bg-light"
                alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>
  

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <a href="" class="brand-link mb-3" style="margin-left: -16px; margin-top: -13px;">
            <img src="{{ asset('backend') }}/dist/email.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 bg-light" style="opacity: .8">
            <span class="brand-text font-weight-light" style="font-size: 16px;">{{ Auth::user()->email }}</span>
        </a>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

                <!-- Dashboard menu -->
                <li class="nav-item menu-open">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>

                <!-- category menu -->
                @if (Auth::user()->role == 1)
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ Request::is('admin/category*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-bars"></i>
                            <p>
                                Manage Category
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('category.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('category.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Category</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Sub category menu -->
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ Request::is('admin/sub-category*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-bars"></i>
                            <p>
                                Manage Sub Category
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('sub-category.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Sub Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('sub-category.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Sub Category</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Tag menu -->
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ Request::is('admin/tag*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-bars"></i>
                            <p>
                                Manage Tag
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('tag.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Tag</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('tag.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Tag</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- Post section menu -->
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Request::is('admin/post*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-file-export"></i>
                        <p>
                            Manage Post
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('post.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Post</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('post.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Post</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- ticket setting section menu -->
                @if (Auth::user()->role == 1)
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ Request::is('admin/ticket*') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-headset"></i>
                            <p>
                                Ticket
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('ticket.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Ticket</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <!-- contact setting section menu -->
                @if (Auth::user()->role == 1)
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ Request::is('admin/contact*') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-phone"></i>
                            <p>
                                Contact
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.contact.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Contact</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->role == 2)
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Request::is('admin/ticket*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-headset"></i>
                        <p>
                            Ticket
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('open.ticket') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Open Ticket</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if (Auth::user()->role == 1)
                    <!-- website setting section menu -->
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ Request::is('admin/website*') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-gear"></i>
                            <p>
                                Setting
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('website.setting') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Setting</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->role == 1)
                    <!-- Profile Section -->
                    <li class="nav-header text-uppercase">Profile</li>
                    <li class="nav-item">
                        <a href="{{ route('profile.index') }}"
                            class="nav-link {{ Request::is('admin/passwordChange*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Profile</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.password.change') }}"
                            class="nav-link {{ Request::is('admin/passwordChange*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-circle text-warning"></i>
                            <p>Password Change</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                            class="nav-link {{ Request::is('admin/passwordChange*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p>Logout</p>
                        </a>
                        <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none">
                            @csrf
                        </form>
                    </li>
                @endif

                @if (Auth::user()->role == 2)
                    <li class="nav-header text-uppercase">Profile</li>
                    <li class="nav-item">
                        <a href="{{ route('user.profile.index') }}"
                            class="nav-link {{ Request::is('admin/passwordChange*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Profile</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.password.change')}}"
                            class="nav-link {{ Request::is('admin/passwordChange*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-circle text-warning"></i>
                            <p>Password Change</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                            class="nav-link {{ Request::is('admin/passwordChange*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p>Logout</p>
                        </a>
                        <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none">
                            @csrf
                        </form>
                    </li>
                @endif
                <span class="mb-5"></span>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
