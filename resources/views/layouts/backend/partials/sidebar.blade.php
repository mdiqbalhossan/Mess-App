<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                {{-- <img src="{{ asset('/storage') }}/{{ get_setting('logo_url') }}" alt="" width="48px"> --}}
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Amanullah House</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('member') ? 'active' : '' }}">
            <a href="{{ route('member.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Analytics">Member</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('meal') ? 'active' : '' }}">
            <a href="{{ route('meal.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-time"></i>
                <div data-i18n="Analytics">Meal</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('deposit') ? 'active' : '' }}">
            <a href="{{ route('deposit') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-credit-card"></i>
                <div data-i18n="Analytics">Deposit</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('minuslist') ? 'active' : '' }}">
            <a href="{{ route('minuslist') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-minus-circle"></i>
                <div data-i18n="Analytics">Minus List</div>
            </a>
        </li>
        @if(auth()->user()->is_admin == 1)
        <li class="menu-item {{ request()->is('manager') ? 'active' : '' }}">
            <a href="{{ route('manager.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics">Manager</div>
            </a>
        </li>
        @endif
        @if(auth()->user()->is_admin == 1)
            <li class="menu-item {{ request()->is('notice') ? 'active' : '' }}">
                <a href="{{ route('notice.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-bell-plus"></i>
                    <div data-i18n="Analytics">Notice</div>
                </a>
            </li>
        @endif
        @if(auth()->user()->is_admin == 1)
        <li class="menu-item {{ request()->is('setting') ? 'active' : '' }}">
            <a href="{{ route('setting.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Analytics">Setting</div>
            </a>
        </li>
        @endif
    </ul>
</aside>
