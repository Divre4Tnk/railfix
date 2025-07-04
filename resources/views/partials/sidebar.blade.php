<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('dashboard.index') }}" class="b-brand text-primary">
                <img src="{{ asset('assets/images/logo.svg') }}" class="img-fluid logo-lg" alt="logo" width="140">
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">                
                <li class="pc-item {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-home"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Data Master</label>
                    <i class="ti ti-dashboard"></i>
                </li>
                <li class="pc-item {{ request()->routeIs('location.*') ? 'active' : '' }}">
                    <a href="{{ route('location.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-map-pin"></i></span>
                        <span class="pc-mtext">Data Lokasi</span>
                    </a>
                </li>
                <li class="pc-item {{ request()->routeIs('inventories.*') ? 'active' : '' }}">
                    <a href="{{ route('inventories.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-box"></i></span>
                        <span class="pc-mtext">Data Inventory</span>
                    </a>
                </li>
                <li class="pc-item {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-user"></i></span>
                        <span class="pc-mtext">Data Admin</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Lainnya</label>
                    <i class="ti ti-news"></i>
                </li>
                <li class="pc-item {{ request()->routeIs('find.*') ? 'active' : '' }}">
                    <a href="{{ route('find.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-search"></i></span>
                        <span class="pc-mtext">Find it</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
