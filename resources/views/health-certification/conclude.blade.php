@extends('layouts.default')

@section('title') Kết luận giấy khám bệnh @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Kết luận giấy khám bệnh</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('health_certifications.index') }}" title="Quản lý giấy khám bệnh" data-toggle="tooltip" data-placement="top">Quản lý giấy khám bệnh</a></li>
                                    <li class="breadcrumb-item active">Kết luận giấy khám bệnh</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="{{ route('health_certifications.update-conclude', $data_edit->id) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Thông tin cơ bản</h4>
                                    <p class="card-title-desc">Điền tất cả thông tin bên dưới</p>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="title">Tiêu đề</label>
                                                <input disabled id="title" name="title" type="text" class="form-control" value="{{ $data_edit->title }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="patient_id">Tên bệnh nhân</label>
                                                        <input disabled id="patient_id" name="patient_id" type="text" class="form-control" value="{{ $data_edit->patient->name }}">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="patient_id" class="mt-2">Thẻ BHYT</label>
                                                    <div class="custom-control custom-checkbox  custom-checkbox-danger mb-3">
                                                        <input type="checkbox" class="custom-control-input" id="check_insurance_card" disabled {{ $data_edit->is_health_insurance_card ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="check_insurance_card">Miễn phí dịch vụ khám</label>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="total_money">Giá</label>
                                                        <input disabled id="total_money" name="total_money" type="text" class="form-control" value="{{ number_format($data_edit->total_money, 0, ',', '.') }} VNĐ">
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="consulting_room_id">Phòng khám</label>
                                                <input disabled id="consulting_room_id" name="consulting_room_id" type="text" class="form-control" value="{{ $data_edit->consultingRoom->name }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="user_id">Bác sĩ</label>
                                                <input disabled id="user_id" name="user_id" type="text" class="form-control" value="{{ $data_edit->user->name }}">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-3">Kết quả khám</h4>

                                    <div class="form-group">
                                        <label for="title">Kết luận <span class="text-danger">*</span></label>
                                        <textarea id="conclude" class="summernote mb-2" name="conclude"></textarea>
                                        {!! $errors->first('conclude', '<span class="error mt-1 d-block">:message</span>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="treatment_guide">Hướng dẫn điều trị <span class="text-danger">*</span></label>
                                        <textarea id="treatment_guide" class="summernote mb-2" name="treatment_guide"></textarea>
                                        {!! $errors->first('treatment_guide', '<span class="error mt-1 d-block">:message</span>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="suggestion">Đề nghị khám</label>
                                        <textarea id="suggestion" class="summernote mb-2" name="suggestion"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
                                    <a href="{{ route('health_certifications.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
                                </div>

                            </div>
                        </form>


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

    <!-- Summernote js -->
    <script src="{{ asset('libs\summernote\summernote-bs4.min.js') }}"></script>
    <!-- init js -->
    <script src="{{ asset('js\pages\form-editor.init.js') }}"></script>

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

    <!-- Summernote css -->
    <link href="{{ asset('libs\summernote\summernote-bs4.min.css') }}" rel="stylesheet" type="text/css">

    <!-- select2 css -->
    <link href="{{ asset('libs\select2\css\select2.min.css') }}" rel="stylesheet" type="text/css">
@endpush