<div id="layoutSidenav_nav">

    <div class="user_profile">
        <img class="profile-image"
            src="{{ asset('assets/img/no-img.jpg') }}"
            alt="">

        <div class="profile-title">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
        <div class="profile-description">{{ Auth::user()->roles->name }}</div>
    </div>

    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">

            <div class="nav">
                @if (Helper::hasRight('setting.view'))
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#settingNav"
                        aria-expanded="@if(Route::is('admin.setting.general') || Route::is('admin.setting.static.content') || Route::is('admin.setting.legal.content') || Route::is('admin.contact') || Route::is('admin.resource')) true @else false @endif" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div> Setup
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse @if(Route::is('admin.setting.general') || Route::is('admin.setting.static.content') || Route::is('admin.setting.legal.content') || Route::is('admin.contact') || Route::is('admin.resource')) show @endif" id="settingNav" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav down">
                            @if (Helper::hasRight('setting.general'))
                                <a class="nav-link {{ Route::is('admin.setting.general') ? 'active' : '' }}"
                                    href="{{ route('admin.setting.general') }}"><i class="fa-solid fa-angles-right ikon"></i> General Setting </a>
                            @endif

                            @if (Helper::hasRight('setting.static-content'))
                                <a class="nav-link {{ Route::is('admin.setting.static.content') ? 'active' : '' }}"
                                    href="{{ route('admin.setting.static.content') }}"><i class="fa-solid fa-angles-right ikon"></i> Static Content</a>
                            @endif

                            @if (Helper::hasRight('setting.legal-content'))
                                <a class="nav-link {{ Route::is('admin.setting.legal.content') ? 'active' : '' }}"
                                    href="{{ route('admin.setting.legal.content') }}"><i class="fa-solid fa-angles-right ikon"></i> Legal Content</a>
                            @endif
                        </nav>
                    </div>
                @endif


                {{-- admin  --}}
                @if (Helper::hasRight('setting.view'))
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#setupNav"
                        aria-expanded="@if(Route::is('admin.role') || Route::is('admin.role.create') || Route::is('admin.role.edit') || Route::is('admin.role.right') || Route::is('admin.partner') || Route::is('admin.partner.product') || Route::is('admin.user')) true @else false @endif" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user-shield"></i></div> Administration
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse @if(Route::is('admin.role') || Route::is('admin.role.create') || Route::is('admin.role.edit') || Route::is('admin.role.right') || Route::is('admin.partner') || Route::is('admin.partner.product') || Route::is('admin.user')) show @endif" id="setupNav" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav down">
                            @if (Helper::hasRight('role.view'))
                                <a class="nav-link {{ Route::is('admin.role') || Route::is('admin.role.create') || Route::is('admin.role.edit') ? 'active' : '' }}"
                                    href="{{ route('admin.role') }}"><i class="fa-solid fa-angles-right ikon"></i> Role Management</a>
                            @endif
                            @if (Helper::hasRight('right.view'))
                                <a class="nav-link {{ Route::is('admin.role.right') ? 'active' : '' }}"
                                    href="{{ route('admin.role.right') }}"><i class="fa-solid fa-angles-right ikon"></i> Right Management</a>
                            @endif
                            {{-- @if (Helper::hasRight('partner.view'))
                                <a class="nav-link {{ Route::is('admin.partner') ? 'active' : '' }}"
                                    href="{{ route('admin.partner') }}"><i class="fa-solid fa-angles-right ikon"></i> Partner Management
                                </a>
                            @endif --}}

                            @if (Helper::hasRight('user.view'))
                                <a class="nav-link {{ Route::is('admin.user') ? 'active' : '' }}"
                                    href="{{ route('admin.user') }}"><i class="fa-solid fa-angles-right ikon"></i> User Management
                                </a>
                            @endif
                        </nav>
                    </div>
                @endif


                @if (Helper::hasRight('dashboard.view'))
                    <a class="nav-link {{ Route::is('admin.index') ? 'active' : '' }}"
                        href="{{ route('admin.index') }}" >
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div> Dashboard
                    </a>
                @endif

                @if (Helper::hasRight('event.view'))
                    <a class="nav-link {{ Route::is('admin.event') ? 'active' : '' }}"
                        href="{{ route('admin.event') }}">
                        <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar-days"></i></div> Event Management
                    </a>
                @endif

                @if (Helper::hasRight('menu.view'))
                    <a class="nav-link {{ Route::is('admin.menu') ? 'active' : '' }}"
                        href="{{ route('admin.menu') }}">
                        <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar-days"></i></div> Menu Management
                    </a>
                @endif

            </div>
        </div>
    </nav>
</div>
