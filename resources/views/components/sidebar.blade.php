
    @if(Auth::guard('admin')->check())
    @php
    $registerForm = 'block';
    $route = 'admin/home';
    $index = 'admin.index';
    @endphp
    @elseif(Auth::guard('user')->check())
    @php
    $registerForm ='none';
    $route = 'user/home';
    $index = 'user.index';
    @endphp
    @endif

<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('dist/img/logo/logo2.png') }}">
        </div>
        <div class="sidebar-brand-text mx-3">RuangHT</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item{{ request()->is($route) ? ' active' : ''}}">
        <a class="nav-link" href="{{ route($index) }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Features
    </div>

    <!-- Nav item untuk Data Table -->
    <li class="nav-item" style="display: <?= $registerForm ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDataTable" aria-expanded="true" aria-controls="collapseDataTable">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Data Table</span>
        </a>
        <div id="collapseDataTable" class="collapse
        @if (request()->is('pengguna-table') || request()->is('pegawai-table') || request()->is('lokasi-table'))
        show
        @endif" aria-labelledby="headingDataTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Table</h6>
                <a class="collapse-item{{ request()->is('pengguna-table') ? ' active' : '' }}" href="{{ route('pengguna-table') }}">Data Pengguna</a>
                <a class="collapse-item{{ request()->is('lokasi-table') ? ' active' : '' }}" href="{{ route('lokasi-table') }}">Data Alamat</a>
            </div>
        </div>
    </li>


    <!-- Nav item untuk Input Form -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInputForm" aria-expanded="true" aria-controls="collapseInputForm">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Input Form</span>
        </a>
        <div id="collapseInputForm" class="collapse
        @if (request()->is('listHt-table') || request()->is('listAlat-table') || request()->is('assignHtLokasi'))
        show
        @endif" aria-labelledby="headingInputForm" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Input Form</h6>
                <a class="collapse-item{{ request()->is('assignHtLokasi') ? ' active' : '' }}" href="{{ route('assignHtLokasi') }}">Assign HT</a>
                <a class="collapse-item{{ request()->is('listHt-table') ? ' active' : '' }}" href="{{ route('listHt-table') }}" style="display: <?= $registerForm ?>">List HT</a>
                <a class="collapse-item{{ request()->is('listAlat-table') ? ' active' : '' }}" href="{{ route('listAlat-table') }}" style="display: <?= $registerForm ?>">List Alat</a>
            </div>
        </div>
    </li>

    <!-- Nav item untuk tambah user -->
    <li class="nav-item" style="display: <?= $registerForm ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTambahUser" aria-expanded="true" aria-controls="collapseTambahUser">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>User Settings</span>
        </a>
        <div id="collapseTambahUser" class="collapse
        @if (request()->is('dataAdmin') || request()->is('dataUser'))
        show
        @endif" aria-labelledby="headingTambahUser" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User Settings</h6>
                <a class="collapse-item{{ request()->is('dataAdmin') ? ' active' : '' }}" href="{{ route('dataAdmin') }}">Data Admin</a>
                <a class="collapse-item{{ request()->is('dataUser') ? ' active' : '' }}" href="{{ route('dataUser') }}">Data User</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">
    <div class="version" id="version-shtms"></div>
</ul>