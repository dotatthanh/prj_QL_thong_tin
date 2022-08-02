<x-app-layout>
   @section('content')
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-soft-primary">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Đăng ký miễn phí</h5>
                                            <p>Nhận tài khoản Skote miễn phí của bạn ngay bây giờ.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{ asset('images\profile-img.png') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <div>
                                    <a href="index.html">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{ asset('images\logo.svg') }}" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                </div>

                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                <div class="p-2">
                                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="form-group">
                                            <label for="username">Tên đăng nhập</label>
                                            <input type="text" class="form-control" id="username" placeholder="Nhập tên đăng nhập" name="username">        
                                        </div>
                
                                        <div class="form-group">
                                            <label for="name">Họ và tên</label>
                                            <input type="text" class="form-control" id="name" placeholder="Nhập họ và tên" name="name">
                                        </div>
                
                                        <div class="form-group">
                                            <label for="userpassword">Mật khẩu</label>
                                            <input type="password" class="form-control" id="userpassword" placeholder="Nhập mật khẩu" required autocomplete="new-password" name="password">
                                        </div>

                                        <div class="form-group">
                                            <label for="password_confirmation">Xác nhận mật khẩu</label>
                                            <input type="password" class="form-control" id="password_confirmation" placeholder="Nhập xác nhận mật khẩu" name="password_confirmation" required>        
                                        </div>

                                        <div class="form-group">
                                            <label for="birthday">Ngày sinh</label>
                                            <div class="docs-datepicker">
                                                <div class="input-group">
                                                    <input type="text" class="form-control docs-date" name="birthday" placeholder="Chọn ngày sinh" autocomplete="off">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-outline-secondary docs-datepicker-trigger" disabled="">
                                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="docs-datepicker-container"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="gender">Giới tính</label>
                                            <div class="form-check form-check">
                                                <input type="radio" class="form-check-input" id="nam" name="gender" value="Nam" checked>
                                                <label class="form-check-label" for="nam">Nam</label>
                                            </div>
                                            <div class="form-check form-check">
                                                <input type="radio" class="form-check-input" id="nu" name="gender" value="Nữ">
                                                <label class="form-check-label" for="nu">Nữ</label>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="address">Địa chỉ</label>
                                            <input type="text" class="form-control" id="address" placeholder="Nhập địa chỉ" name="address">
                                        </div>

                                        <div class="form-group">
                                            <label for="avatar">Ảnh đại diện</label>
                                            <input type="file" class="form-control" id="avatar" name="avatar">
                                        </div>
                    
                                        <div class="mt-4">
                                            <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Đăng ký</button>
                                        </div>

                                    </form>
                                </div>
            
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            
                            <div>
                                <p>Bạn có sẵn sàng tạo tài khoản ? <a href="{{ route('login') }}" class="font-weight-medium text-primary"> Đăng nhập</a> </p>
                                <p>© 2020 Skote. Được phát hành bởi <i class="mdi mdi-heart text-danger"></i> Themesbrand</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection('content')

    @push('js')
        <!-- select 2 plugin -->
        <script src="{{ asset('libs\select2\js\select2.min.js') }}"></script>

        <!-- init js -->
        <script src="{{ asset('js\pages\ecommerce-select2.init.js') }}"></script>

        <!-- datepicker -->
        <script src="{{ asset('libs\bootstrap-datepicker\js\bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('libs\bootstrap-colorpicker\js\bootstrap-colorpicker.min.js') }}"></script>
        <script src="{{ asset('libs\bootstrap-timepicker\js\bootstrap-timepicker.min.js') }}"></script>
        <script src="{{ asset('libs\bootstrap-touchspin\jquery.bootstrap-touchspin.min.js') }}"></script>
        <script src="{{ asset('libs\bootstrap-maxlength\bootstrap-maxlength.min.js') }}"></script>
        <script src="{{ asset('libs\@chenfengyuan\datepicker\datepicker.min.js') }}"></script>
        <!-- form advanced init -->
        <script src="{{ asset('js\pages\form-advanced.init.js') }}"></script>
        <script type="text/javascript">
            $('.docs-date').datepicker({
                format: 'dd-mm-yyyy',
            });
        </script>
    @endpush

    @push('css')
        <!-- datepicker css -->
        <link href="{{ asset('libs\bootstrap-datepicker\css\bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('libs\bootstrap-colorpicker\css\bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('libs\bootstrap-timepicker\css\bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('libs\@chenfengyuan\datepicker\datepicker.min.css') }}">
    @endpush
</x-app-layout>
