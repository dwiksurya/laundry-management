<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
    <ul id="sidebarnav">
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Menus</span>
        </li>

        @role(['staff', 'branch'])
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('order.index') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">{{ __('Order') }}</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('customer.index') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">{{ __('Customer') }}</span>
            </a>
        </li>
        @endrole

        @role('branch')
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('laundry-service.index') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">{{ __('Laundry Service') }}</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('staff.index') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">{{ __('Staff') }}</span>
            </a>
        </li>
        @endrole

        @role('admin')
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('branch.index') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">{{ __('Branch') }}</span>
            </a>
        </li>
        @endrole
    </ul>
</nav>
