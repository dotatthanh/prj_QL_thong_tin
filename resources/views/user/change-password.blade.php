@extends('layouts.default')

@section('title') Đổi mật khẩu @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Đổi mật khẩu</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item active">Đổi mật khẩu</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Thông tin cơ bản</h4>
                                <p class="card-title-desc">Điền tất cả thông tin bên dưới</p>

                                <form method="POST" action="{{ route('users.change-password', auth()->id()) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row justify-content-center">
                                        <div class="col-sm-3">
                                            <label for="name">Mật khẩu hiện tại <span class="text-danger">*</span> :</label>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <input name="password_old" type="password" class="form-control" placeholder="Nhập mật khẩu hiện tại">
                                                {!! $errors->first('password_old', '<span class="error">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-sm-3">
                                            <label for="name">Mật khẩu mới <span class="text-danger">*</span> :</label>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <input name="password" type="password" class="form-control" placeholder="Nhập mật khẩu hiện tại">
                                                {!! $errors->first('password', '<span class="error">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row justify-content-center">
                                        <div class="col-sm-3">
                                            <label for="name">Nhập lại mật khẩu mới <span class="text-danger">*</span> :</label>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <input name="password_confirmation" type="password" class="form-control" placeholder="Nhập mật khẩu hiện tại">
                                                {!! $errors->first('password_confirmation', '<span class="error">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row justify-content-center">
                                        <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
                                        <a href="{{ route('users.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


      
    </div>
@endsection

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
    <link href="{{ asset('libs\select2\css\select2.min.css') }}" rel="stylesheet" type="text/css">
    <!-- datepicker css -->
    <link href="{{ asset('libs\bootstrap-datepicker\css\bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs\bootstrap-colorpicker\css\bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs\bootstrap-timepicker\css\bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('libs\@chenfengyuan\datepicker\datepicker.min.css') }}">
@endpush