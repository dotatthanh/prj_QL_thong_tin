<div class="vertical-menu">

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

                @can('Xem danh sách thiết bị')
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bx-cog"></i><span class="badge badge-pill badge-info float-right">02</span>
                        <span>Thiết bị</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('device.transmission') }}">Truyền dẫn</a></li>
                        <li><a href="{{ route('device.television') }}">Truyền hình truyền số liệu</a></li>
                    </ul>
                </li>
                @endcan

                {{-- @can('Xem danh sách trạm') --}}
                    <li>
                        <a href="{{ route('transmission_streams.index') }}" class=" waves-effect">
                            <i class="bx bx-calendar"></i>
                            <span>Luồng truyền dẫn</span>
                        </a>
                    </li>
                {{-- @endcan --}}

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
</div>