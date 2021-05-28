<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('index') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('dist/img/logo/logo2.png') }}">
        </div>
        <div class="sidebar-brand-text mx-3">RuangAdmin</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item{{ request()->is('admin') ? ' active' : ''}}">
        <a class="nav-link" href="{{ route('index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Features
    </div>

    <!-- Nav item untuk Data Table -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDataTable" aria-expanded="true" aria-controls="collapseDataTable">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Datac Table</span>
        </a>
        <div id="collapseDataTable" class="collapse
        @if (request()->is('admin/detailHt') || request()->is('admin/lokasi-table'))
        show
        @endif" aria-labelledby="headingDataTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Table</h6>
                <a class="collapse-item{{ request()->is('admin/pengguna-table') ? ' active' : '' }}" href="{{ route('pengguna-table') }}">Data Pengguna</a>
                <a class="collapse-item{{ request()->is('admin/lokasi-table') ? ' active' : '' }}" href="{{ route('lokasi-table') }}">Data Lokasi</a>
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
        @if (request()->is('admin/forms-datareference'))
        show
        @endif" aria-labelledby="headingInputForm" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Input Form</h6>
            </div>
        </div>
    </li>

    <!-- Ignore here untill... -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
            aria-controls="collapseForm">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>Forms</span>
        </a>
        <div id="collapseForm" class="collapse
        @if (request()->is('admin/forms-basic') || request()->is('admin/forms-advanced'))
        show
        @endif" aria-labelledby="headingForm" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Forms</h6>
                <a class="collapse-item{{ request()->is('admin/forms-basic') ? ' active' : '' }}" href="{{ route('forms-basic') }}">Form Basics</a>
                <a class="collapse-item{{ request()->is('admin/forms-advanced') ? ' active' : '' }}" href="{{ route('forms-advanced') }}">Form Advanceds</a>
            </div>
        </div>
    </li>
<!-- here -->
    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>
</ul>