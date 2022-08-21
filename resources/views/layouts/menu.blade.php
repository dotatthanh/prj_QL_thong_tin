{{-- <div class="vertical-menu">

    <div data-simplebar="" class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Quản lý</li>

                <li>
                    <a href="{{ route('dashboard') }}" class=" waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span>Trang chủ</span>
                    </a>
                </li>

                @can('Xem danh sách đơn vị BĐKT')
                    <li>
                        <a href="{{ route('units.index') }}" class=" waves-effect">
                            <i class="bx bx-calendar"></i>
                            <span>Đơn vị BĐKT</span>
                        </a>
                    </li>
                @endcan

                @can('Xem danh sách trạm')
                    <li>
                        <a href="{{ route('stations.index') }}" class=" waves-effect">
                            <i class="bx bx-calendar"></i>
                            <span>Trạm</span>
                        </a>
                    </li>
                @endcan

                @can('Xem danh sách luồng truyền dẫn')
                    <li>
                        <a href="{{ route('transmission_streams.index') }}" class=" waves-effect">
                            <i class="bx bx-calendar"></i>
                            <span>Luồng truyền dẫn</span>
                        </a>
                    </li>
                @endcan

                @can('Xem danh sách luồng TH-TSL')
                    <li>
                        <a href="{{ route('tv_streams.index') }}" class=" waves-effect">
                            <i class="bx bx-calendar"></i>
                            <span>Luồng TH-TSL</span>
                        </a>
                    </li>
                @endcan

                @can('Xem danh sách phần mềm hỗ trợ')
                    <li>
                        <a href="{{ route('softwares.index') }}" class=" waves-effect">
                            <i class="bx bx-calendar"></i>
                            <span>Phần mềm hỗ trợ</span>
                        </a>
                    </li>
                @endcan

                @can('Xem danh sách tài liệu')
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bx-cog"></i><span class="badge badge-pill badge-info float-right">03</span>
                        <span>Tài liệu</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('document.video') }}">Tài liệu video</a></li>
                        <li><a href="{{ route('document.read') }}">Tài liệu đọc</a></li>
                        <li><a href="{{ route('document.english') }}">Tiếng anh chuyên ngành</a></li>
                    </ul>
                </li>
                @endcan

                @can('Xem danh sách tài khoản', 'Xem danh sách vai trò', 'Xem danh sách quyền')
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bx-cog"></i><span class="badge badge-pill badge-info float-right">03</span>
                        <span>Cài đặt</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('Xem danh sách tài khoản')
                        <li><a href="{{ route('users.index') }}">Tài khoản</a></li>
                        @endcan
                        @can('Xem danh sách vai trò')
                        <li><a href="{{ route('roles.index') }}">Vai trò</a></li>
                        @endcan
                        @can('Xem danh sách quyền')
                        <li><a href="{{ route('permissions.index') }}">Quyền</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div> --}}

<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="bx bx-home-circle me-2"></i><span>Trang chủ</span>
                        </a>
                    </li>

                    @can('Xem danh sách đơn vị BĐKT')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('units.index') }}">
                            <i class="bx bx-home-circle me-2"></i><span>Đơn vị BĐKT</span>
                        </a>
                    </li>
                    @endcan

                    @can('Xem danh sách trạm')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('stations.index') }}">
                                <i class="bx bx-calendar"></i>
                                <span>Trạm</span>
                            </a>
                        </li>
                    @endcan

                    @can('Xem danh sách luồng truyền dẫn')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('transmission_streams.index') }}">
                            <i class="bx bx-calendar"></i>
                            <span>Luồng truyền dẫn</span>
                        </a>
                    </li>
                    @endcan

                    @can('Xem danh sách luồng TH-TSL')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tv_streams.index') }}">
                            <i class="bx bx-calendar"></i>
                            <span>Luồng TH-TSL</span>
                        </a>
                    </li>
                    @endcan

                    @can('Xem danh sách phần mềm hỗ trợ')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('softwares.index') }}">
                            <i class="bx bx-calendar"></i>
                            <span>Phần mềm hỗ trợ</span>
                        </a>
                    </li>
                    @endcan

                    @can('Xem danh sách tài liệu')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" role="button">
                            <i class="bx bx-customize me-2"></i><span key="t-apps">Tài liệu</span> 
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-pages">
                            <a class="dropdown-item" href="{{ route('document.video') }}">Tài liệu video</a>
                            <a class="dropdown-item" href="{{ route('document.read') }}">Tài liệu đọc</a>
                            <a class="dropdown-item" href="{{ route('document.english') }}">Tiếng anh chuyên ngành</a>
                        </div>
                    </li>
                    @endcan

                    @can('Xem danh sách tài liệu')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" role="button">
                            <i class="bx bx-customize me-2"></i><span key="t-apps">Cài đặt</span> 
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-pages">
                            @can('Xem danh sách tài khoản')
                            <a class="dropdown-item" href="{{ route('users.index') }}">Tài khoản</a>
                            @endcan
                            @can('Xem danh sách vai trò')
                            <a class="dropdown-item" href="{{ route('roles.index') }}">Vai trò</a>
                            @endcan
                            @can('Xem danh sách quyền')
                            <a class="dropdown-item" href="{{ route('permissions.index') }}">Quyền</a>
                            @endcan
                        </div>
                    </li>
                    @endcan
                </ul>
            </div>
        </nav>
    </div>
</div>