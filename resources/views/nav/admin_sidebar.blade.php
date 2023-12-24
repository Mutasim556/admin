<ul class="sidebar-links" id="simple-bar">
    <li class="sidebar-list">
        <a class="sidebar-link sidebar-title link-nav" href="{{ route('home') }}"
            aria-expanded="false"><i data-feather="home"></i><span
                >{{ __('admin_local.Dashboard') }}</span>
        </a>
    </li>
    <li class="sidebar-list">
        <a class="sidebar-link sidebar-title" href="javascript:void(0)"
            aria-expanded="false">
            <i data-feather="user-plus"></i>
            <span class="lan-3">{{ __('admin_local.Users') }}</span>
        </a>
        <ul class="sidebar-submenu">

            <li>
                <a href="{{ route('user.index') }}" class="sidebar-link">
                    <span > {{ __('admin_local.User List') }} </span>
                </a>
            </li>
        </ul>
    </li>
    <li class="sidebar-list">
        <a class="sidebar-link sidebar-title" href="javascript:void(0)"
            aria-expanded="false">
            <i data-feather="award"></i>
            <span class="lan-3">{{ __('admin_local.Doctor Section') }}</span>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="{{ route('chamber.index') }}" class="sidebar-link">
                    <span > {{ __('admin_local.Chamber List') }} </span>
                </a>
            </li>
            <li>
                <a href="{{ route('speciality.index') }}" class="sidebar-link">
                    <span > {{ __('admin_local.Doctor Speciality') }} </span>
                </a>
            </li>
            <li>
                <a href="{{ route('department.index') }}" class="sidebar-link">
                    <span > {{ __('admin_local.Doctor Department') }} </span>
                </a>
            </li>
        </ul>
    </li>

    <li class="sidebar-list">
        <a class="sidebar-link sidebar-title" href="javascript:void(0)"
            aria-expanded="false">
            <i data-feather="slack"></i>
            <span class="lan-3">{{ __('admin_local.Language') }}</span>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="{{ route('language.index') }}" class="sidebar-link">
                    <span > {{ __('admin_local.Language List') }} </span>
                </a>
            </li>
            <li>
                <a href="{{ route('language.admin_language') }}" class="sidebar-link">
                    <span > {{ __('admin_local.Admin Language') }} </span>
                </a>
            </li>
            <li>
                <a href="" class="sidebar-link">
                    <span > {{ __('admin_local.Frontend Language') }} </span>
                </a>
            </li>
        </ul>
    </li>
</ul>
