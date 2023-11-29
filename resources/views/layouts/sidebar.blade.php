<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/" class="brand-link">
    <i class="fa-solid fa-shirt me-2"></i>
    {{-- <img src="{{ asset('assets/dist/img/lambang_kota_palu.png')}}" alt="AdminLTE Logo" class="brand-image " style="opacity: .8"> --}}
    <span class="brand-text font-weight-light">E Tailor App</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{ url('cms/dashboard') }}" id="dashboard" class="nav-link">
            <i class="nav-icon fa-solid fa-house"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="/cms/tailor" class="nav-link">
            <i class="nav-icon fa-solid fa-file-arrow-down"></i>
            <p>Tailor</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/cms/packages" class="nav-link">
            <i class="nav-icon fa-solid fa-file-arrow-down"></i>
            <p>Paket</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('cms/usermanagement') }}" id="userManagement" class="nav-link">
            <i class="nav-icon fa-solid fa-user"></i>
            <p>User Management</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="/booking"  class="nav-link">
            <i class="nav-icon fa-solid fa-file-arrow-down"></i>
            <p>Booking</p>
          </a>
        </li>



        {{-- @if (auth()->user()->role=='admin')
          <li class="nav-item">
            <a href="/jenis-surat" id="jenisSurat" class="nav-link">
              <i class="nav-icon fa-solid fa-file-lines"></i>
              <p>Jenis Surat</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="add-user" id="addUser" class="nav-link">
              <i class="nav-icon fa-solid fa-user-plus"></i>
              <p>Add User</p>
            </a>
          </li>
        @endif --}}



      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
  {{-- <footer class="text-white d-flex align-items-end bg-danger" style="position: absolute; top: 1px; height: 10vh;">
    <small>Copy Right © By Jocodes</small>
  </footer> --}}
</aside>
