<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
            </svg>
            {{ __('Dashboard') }}
        </a>
    </li>

    @can('manage_users')
        <li class="nav-group {{ request()->is('admin/users/*') || request()->is('admin/roles/*') ? 'active' : '' }}"
            aria-expanded="{{ request()->is('admin/users/*') || request()->is('admin/roles/*') ? 'show' : '' }}"
            aria-expanded="{{ request()->is('admin/users/*') || request()->is('admin/roles/*') ? 'true' : 'false' }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
                </svg>
                {{ __('Users') }}
            </a>
            <ul class="nav-group-items" style="height: auto;">
                <li class="nav-item active">
                    <a class="nav-link " href="{{ route('users.index') }}">
                        <svg class="nav-icon">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                        </svg>
                        {{ __('Users') }}
                    </a>
                </li>


                @can('manage_roles')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('roles.index') }}">
                            <svg class="nav-icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-user-follow') }}"></use>
                            </svg>
                            {{ __('Roles') }}
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan

    @can('manage_customers')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('customers.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-user-follow') }}"></use>
                </svg>
                {{ __('Customers') }}
            </a>
        </li>
    @endcan

    <div class="d-md-none">
        <div class="nav-title">{{ __('Settings') }}</div>
        <li class="nav-group ">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-cog') }}"></use>
                </svg>
                {{ __('Setting') }}
            </a>
            <ul class="nav-group-items" style="height: auto;">
                <li class="nav-item {{ request()->is('profile/*') ? 'active' : '' }}"
                    aria-expanded="{{ request()->is('profile/*') ? 'show' : '' }}"
                    aria-expanded="{{ request()->is('profile/*') ? 'true' : 'false' }}">
                    <a class="nav-link " href="{{ route('profile.show') }}">
                        <svg class="nav-icon">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                        </svg>
                        {{ __('My Profile') }}
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="{{ route('toggle.theme') }}">
                        <svg class="nav-icon">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-moon') }}"></use>
                        </svg>
                        {{ __('Toggle Theme') }}
                    </a>
                </li>

                <li class="nav-item">
                    <form method="POST" class="nav-link" action="{{ route('logout') }}">
                        @csrf
                        <svg class="nav-icon">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-account-logout') }}"></use>
                        </svg>
                        {{ __('Logout') }}
                    </form>
                </li>

            </ul>
        </li>
    </div>
</ul>
