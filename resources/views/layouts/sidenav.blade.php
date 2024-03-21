<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('asset/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('asset/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @foreach (getMenus() as $menu)
                    <li class="nav-item {{ request()->segment(1) == $menu->url ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->segment(1) == $menu->url ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                {{ $menu->name }}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @foreach ($menu->subMenus as $subMenu)
                                <li class="nav-item">
                                    <a href="{{ $subMenu->url }}"
                                       class="nav-link {{ request()->is($subMenu->url . '*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ $subMenu->name }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        
                    </li>
                @endforeach
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf <!-- CSRF protection -->
                        <!-- No input fields are needed for logout, so the form can be empty -->
                        <button type="submit" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Logout
                            </p>
                        </button>
                    </form>
                    
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
