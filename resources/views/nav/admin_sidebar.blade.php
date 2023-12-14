<ul class="sidebar-links" id="simple-bar">
    <li class="sidebar-list">
        <a class="sidebar-link sidebar-title link-nav" href="{{ route('home') }}"
            aria-expanded="false"><i data-feather="home"></i><span
                >{{ __('Dashboard') }}</span>
        </a>
    </li>
    <li class="sidebar-list">
        <a class="sidebar-link sidebar-title" href="javascript:void(0)"
            aria-expanded="false">
            <i data-feather="user-plus"></i>
            <span class="lan-3">{{ __('Users') }}</span>
        </a>
        <ul class="sidebar-submenu">
            
            <li>
                <a href="{{ route('user.index') }}" class="sidebar-link">
                    <span > {{ __('User List') }} </span>
                </a>
            </li>
        </ul>
    </li>
</ul>