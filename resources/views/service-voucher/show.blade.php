@extends('layouts.default')

@section('title') Thông tin phiếu dịch vụ @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Thông tin phiếu dịch vụ</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('service_vouchers.index') }}" title="Quản lý phiếu dịch vụ" data-toggle="tooltip" data-placement="top">Quản lý phiếu dịch vụ</a></li>
                                    <li class="breadcrumb-item active">Thông tin phiếu dịch vụ</li>
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
                                        <label>Mã phiếu dịch vụ :</label>
                                    </div>

                                    <div class="col-sm-10">
                                        <label>{{ $data_edit->code }}</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Tên bệnh nhân :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="font-weight-bold">{{ $data_edit->patient->name }}</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Dịch vụ khám :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="font-weight-bold">{{ $data_edit->medicalService->name }}</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Thẻ BHYT :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="custom-control custom-checkbox  custom-checkbox-danger mb-3">
                                            @if ($data_edit->is_health_insurance_card)
                                                <input type="checkbox" class="custom-control-input" id="check_insurance_card" disabled checked>
                                                <label class="custom-control-label" for="check_insurance_card">Miễn phí dịch vụ khám</label>
                                            @else
                                                <input type="checkbox" class="custom-control-input" id="check_insurance_card" disabled>
                                                <label class="custom-control-label" for="check_insurance_card">Miễn phí dịch vụ khám</label>
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
                                        <label>Ngày bắt đầu :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="font-weight-bold">{{ date("d-m-Y", strtotime($data_edit->start_date)) }}</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Ngày kết thúc :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="font-weight-bold">{{ date("d-m-Y", strtotime($data_edit->end_date)) }}</label>
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

                                    <div class="col-sm-4">
                                        @if ($data_edit->payment_status)
                                            <label class="text-success">Đã thanh toán</label>
                                        @else
                                            <label class="text-warning">Chưa thanh toán</label>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                        @if ($data_edit->serviceVoucherDetails->count())      
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-3">Kết quả</h4>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>Chi tiết khám :</label>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-centered table-nowrap">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th class="text-center" width="70px">STT</th>
                                                            <th>Ngày khám</th>
                                                            <th>Kết quả</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php ($stt = 1)
                                                        @foreach ($data_edit->serviceVoucherDetails as $service_voucher_detail)
                                                            <tr>
                                                                <td class="text-center">{{ $stt++ }}</td>
                                                                <td>{{ date("d-m-Y", strtotime($service_voucher_detail->date)) }}</td>
                                                                <td>
                                                                    {!! $service_voucher_detail->result !!}
                                                                </td>
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

                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('service_vouchers.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
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
    <!-- datepicker css -->
    <link href="{{ asset('libs\bootstrap-datepicker\css\bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs\bootstrap-colorpicker\css\bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs\bootstrap-timepicker\css\bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('libs\@chenfengyuan\datepicker\datepicker.min.css') }}">
    <!-- select2 css -->
    <link href="{{ asset('libs\select2\css\select2.min.css') }}" rel="stylesheet" type="text/css">
@endpush