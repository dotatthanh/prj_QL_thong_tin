@extends('layouts.default')

@section('title') Trang chủ @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Trang chủ</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Trang chủ</a></li>
                                    <li class="breadcrumb-item active">Trang chủ</li>
                                </ol>
                            </div>
                        </div>

                        <img src="{{ asset('images/logo.png') }}" alt="" class="w-100">
                    </div>
                </div>

                <div class="row">
                    <div class="col text-center mt-5">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-search">Tìm kiếm</button> 
                        <a class="btn btn-primary ml-5" href="{{ route('dashboard.statistic') }}">Thống kê</a> 
                    </div>

                    <div class="modal fade" id="modal-search" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Tìm kiếm</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form method="GET" action="{{ route('dashboard.search') }}">
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label for="station" class="col-sm-2 col-form-label">Tên trạm :</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" name="station_id">
                                                    <option value="">Chọn trạm</option>
                                                    @foreach ($stations as $station)
                                                    <option value="{{ $station->id }}">{{ $station->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="device_id" class="col-sm-2 col-form-label">Tên thiết bị :</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" name="device_id">
                                                    <option value="">Chọn thiết bị</option>
                                                    @foreach ($devices as $device)
                                                    <option value="{{ $device->id }}">{{ $device->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="name_card" class="col-sm-2 col-form-label">Tên card :</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="name_card" placeholder="Nhập tên card" name="name_card">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="coordinates" class="col-sm-2 col-form-label">Toạ độ :</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="coordinates" placeholder="Nhập toạ độ" name="coordinates_origin">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="port" class="col-sm-2 col-form-label">Port :</label>
                                            <div class="col-sm-10">
                                                <input type="number" min="1" class="form-control" id="port" placeholder="Nhập port" name="port_origin">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="thread_label" class="col-sm-2 col-form-label">Nhãn luồng :</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="thread_label" placeholder="Nhập nhãn luồng" name="thread_label">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <button type="submit" class="text-white btn btn-success waves-effect waves-light mb-2 mr-2">Tìm kiếm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('js')
    <!-- select 2 plugin -->
    <script src="{{ asset('libs\select2\js\select2.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('js\pages\ecommerce-select2.init.js') }}"></script>
@endpush

@push('css')
    <link href="{{ asset('libs\select2\css\select2.min.css') }}" rel="stylesheet" type="text/css">

    <style>
        .select2 {
            width: 100%!important;
        }
    </style>
@endpush