<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('assets/images/logo-e-tailor.svg')}}" alt="AdminLTE Logo" class="brand-image " style="opacity: .8">
        <h4 class="brand-text fw-bold"  style="color: #CC636F;"><b>E Tailor App</b></h4>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item mt-1 {{ request()->is('cms/dashboard*') ? 'is-active' : '' }}">
                    <a href="{{ url('cms/dashboard') }}" id="dashboard" class="nav-link">
                        <i class="nav-icon fa-solid fa-house fa-icon-custom"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item mt-1 {{ request()->is('cms/tailor*') ? 'is-active' : '' }}">
                    <a href="/cms/tailor" class="nav-link">
                        <i class="nav-icon fa-solid fa-store fa-icon-custom"></i>
                        <p>Rumah Jahit</p>
                    </a>
                </li>
                <li class="nav-item mt-1 {{ request()->is('cms/packages*') ? 'is-active' : '' }}">
                    <a href="/cms/packages" class="nav-link">
                        <i class="nav-icon fa-solid fa-bag-shopping fa-icon-custom"></i>
                        <p>Paket</p>
                    </a>
                </li>
                <li class="nav-item mt-1 {{ request()->is('booking*') ? 'is-active' : '' }}">
                    <a href="/booking" class="nav-link">
                        <i class="nav-icon fa-solid fa-cart-shopping fa-icon-custom"></i>
                        <p>Booking</p>
                    </a>
                </li>
                @if (auth()->user()->role=='admin')
                    <li class="nav-item mt-1 {{ request()->is('cms/usermanagement*') ? 'is-active' : '' }}">
                        <a href="{{ url('cms/usermanagement') }}" id="userManagement" class="nav-link">
                            <i class="nav-icon fa-solid fa-user fa-icon-custom"></i>
                            <p>User Management</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
<!-- /.sidebar-menu -->

        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    {{-- <footer class="text-white d-flex align-items-end bg-danger" style="position: absolute; top: 1px; height: 10vh;">
    <small>Copy Right © By Jocodes</small>
  </footer> --}}
</aside>
