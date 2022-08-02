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
                                            <h5 class="text-primary">Chào mừng trở lại !</h5>
                                            <p>Đăng nhập để tiếp tục Skote.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{ asset('images/profile-img.png') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <div>
                                    <a href="index.html">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{ asset('/images/logo.svg') }}" alt="" class="rounded-circle" height="67">
                                            </span>
                                        </div>
                                    </a>
                                </div>


                                <!-- Session Status -->
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />


                                <div class="p-2">
                                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="username">Tên đăng nhập</label>
                                            <input type="text" class="form-control" id="username" placeholder="Nhập tên đăng nhập" value="{{ old('username') }}" name="username">
                                        </div>

                                        <div class="form-group">
                                            <label for="userpassword">Mật khẩu</label>
                                            <input type="password" class="form-control" id="userpassword" placeholder="Nhập mật khẩu" name="password" autocomplete="current-password">
                                        </div>

                                        <div class="mt-3">
                                            <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Đăng nhập</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="mt-5 text-center">

                            <div>
                                <p>© 2020 Skote. Được phát hành bởi <i class="mdi mdi-heart text-danger"></i> Themesbrand</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection('content')
</x-app-layout>