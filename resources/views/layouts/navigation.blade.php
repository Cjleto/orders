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
        <li class="nav-group {{ request()->is('admin/users/*') || request()->is('admin/roles/*') ? 'active' : '' }}" aria-expanded="{{ request()->is('admin/users/*') || request()->is('admin/roles/*') ? 'show' : '' }}"
            aria-expanded="{{ request()->is('admin/users/*') || request()->is('admin/roles/*') ? 'true' : 'false' }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
                </svg>
                {{ __('Users') }}
            </a>
            <ul class="nav-group-items" style="height: auto;">
                <li class="nav-item active">
                    <a class="nav-link "
                        href="{{ route('users.index') }}">
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

    @can('manage_companies')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('companies.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-restaurant') }}"></use>
                </svg>
                {{ __('Companies') }}
            </a>
        </li>
    @endcan

    @can('manage_macro_categories')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('macro_categories.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-menu') }}"></use>
                </svg>
                {{ __('Categories Settings') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dishes.create', ['user' => auth()->user()]) }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-restaurant') }}"></use>
                </svg>
                {{ __('Create') }} {{ __('Dishes') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('map-entities', ['user' => auth()->user()]) }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-map') }}"></use>
                </svg>
                {{ __('Map') }}
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('company.settings') }}">
                <i class="me-3 fa-solid fa-cog"></i>
                {{ __('Company Settings') }}
            </a>
        </li>

        <hr>

        @if(auth()->user()?->company?->slug)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('public.menu',['company' => auth()->user()->company->slug]) }}" target="_alt">
                <i class="me-3 fa-solid fa-globe"></i>
                {{ __('Public Menu') }}
            </a>
        </li>
        @endif
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
                <li class="nav-item {{ request()->is('profile/*') || request()->is('admin/roles/*') ? 'active' : '' }}" aria-expanded="{{ request()->is('profile/*') || request()->is('admin/roles/*') ? 'show' : '' }}"
                    aria-expanded="{{ request()->is('profile/*') || request()->is('admin/roles/*') ? 'true' : 'false' }}">
                    <a class="nav-link "
                        href="{{ route('profile.show') }}">
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
