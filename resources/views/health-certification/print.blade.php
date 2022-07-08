@extends('layouts.default')

@section('title') In giấy khám bệnh @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">In giấy khám bệnh</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('health_certifications.index') }}" title="Quản lý giấy khám bệnh" data-toggle="tooltip" data-placement="top">Quản lý giấy khám bệnh</a></li>
                                    <li class="breadcrumb-item active">In giấy khám bệnh</li>
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

                                <h4 class="card-title">Thông tin khám</h4>
                                
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>Mã giấy khám bệnh :</label>
                                    </div>

                                    <div class="col-sm-10">
                                        <label>{{ $data_edit->code }}</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Tiêu đề :</label>
                                    </div>

                                    <div class="col-sm-10">
                                        <label>{{ $data_edit->title }}</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>STT khám :</label>
                                    </div>

                                    <div class="col-sm-10">
                                        <label>{{ $data_edit->number }}</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Tên bệnh nhân :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="font-weight-bold">{{ $data_edit->patient->name }}</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Tên phòng khám :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="font-weight-bold">{{ $data_edit->consultingRoom->name }}</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Thẻ BHYT :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <div>
                                            @if ($data_edit->is_health_insurance_card)
                                                <label>Có</label>
                                            @else
                                                <label>Không</label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Tên bác sĩ :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="font-weight-bold">{{ $data_edit->user->name }}</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Trạng thái :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        @if ($data_edit->status)
                                            <label class="text-success">Đã khám</label>
                                        @else
                                            <label class="text-warning">Chưa khám</label>
                                        @endif
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Giá :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="text-danger font-weight-bold">{{ number_format($data_edit->total_money, 0, ',', '.') }} VNĐ</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Thanh toán :</label>
                                    </div>

                                    <div class="col-sm-10">
                                        @if ($data_edit->payment_status)
                                            <label class="text-success">Đã thanh toán</label>
                                        @else
                                            <label class="text-warning">Chưa thanh toán</label>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>

                        @if ($data_edit->status == 1)
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-3">Kết quả khám</h4>

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label>Kết luận :</label>
                                        </div>

                                        <div class="col-sm-10">
                                            <label>{!! $data_edit->conclude !!}</label>
                                        </div>

                                        <div class="col-sm-2">
                                            <label>Hướng dẫn điều trị :</label>
                                        </div>

                                        <div class="col-sm-10">
                                            <label>{!! $data_edit->treatment_guide !!}</label>
                                        </div>

                                        <div class="col-sm-2">
                                            <label>Đề nghị khám lâm sàng :</label>
                                        </div>

                                        <div class="col-sm-10">
                                            <label>{!! $data_edit->suggestion !!}</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                                
                            @if ($data_edit->prescription)        
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-3">Đơn thuốc</h4>

                                        <div class="row">
                                            <div class="col-sm-2">
                                                <label>Mã đơn thuốc :</label>
                                            </div>

                                            <div class="col-sm-10">
                                                <label>{{ $data_edit->prescription->code }}</label>
                                            </div>

                                            <div class="col-sm-2">
                                                <label>Tổng tiền :</label>
                                            </div>

                                            <div class="col-sm-10">
                                                <label class="text-danger font-weight-bold">{{ number_format($data_edit->prescription->total_money, 0, ',', '.') }} VNĐ</label>
                                            </div>

                                            <div class="col-sm-2">
                                                <label>Trạng thái :</label>
                                            </div>

                                            <div class="col-sm-10">
                                                @if ($data_edit->prescription->status)
                                                    <label class="text-success">Đã mua</label>
                                                @else
                                                    <label class="text-warning">Chưa mua</label>
                                                @endif
                                            </div>

                                            <div class="col-sm-12">
                                                <label>Chi tiết đơn thuốc :</label>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="table-responsive">
                                                    <table class="table table-centered table-nowrap">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th class="text-center">STT</th>
                                                                <th>Tên thuốc</th>
                                                                <th>Đơn vị tính</th>
                                                                <th>Số lượng</th>
                                                                <th>Cách dùng</th>
                                                                <th>Giá (VNĐ)</th>
                                                                <th>Tổng tiền (VNĐ)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php ($stt = 1)
                                                            @foreach ($data_edit->prescription->prescriptionDetails as $prescription_detail)
                                                                <tr>
                                                                    <td class="text-center">{{ $stt++ }}</td>
                                                                    <td>{{ $prescription_detail->medicine->name }}</td>
                                                                    <td>
                                                                        {{ $prescription_detail->medicine->unit }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $prescription_detail->amount }}
                                                                    </td>
                                                                    <td>{{ $prescription_detail->use }}</td>
                                                                    <td>{{ number_format($prescription_detail->price, 0, ',', '.') }}</td>
                                                                    <td>{{ number_format($prescription_detail->total_money, 0, ',', '.') }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endif
                        @endif

                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('health_certifications.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
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

        $(document).ready(function() {
            window.print();
        });
    </script>
@endpush

@push('css')
    <!-- datepicker css -->
    <link href="{{ asset('libs\bootstrap-datepicker\css\bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs\bootstrap-colorpicker\css\bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs\bootstrap-timepicker\css\bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('libs\@chenfengyuan\datepicker\datepicker.min.css') }}">
    <!-- select2 css -->
    <link href="{{ asset('libs\select2\css\select2.min.css') }}" rel="stylesheet" type="text/css">
@endpush