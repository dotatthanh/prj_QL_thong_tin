@extends('layouts.default')

@section('title') Thu ngân phiếu dịch vụ @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Danh sách thu ngân phiếu dịch vụ</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Quản lý" data-toggle="tooltip" data-placement="top">Quản lý</a></li>
                                    <li class="breadcrumb-item active">Thu ngân</li>
                                    <li class="breadcrumb-item active">Danh sách thu ngân phiếu dịch vụ</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" action="{{ route('cashier_service_vouchers.index') }}">
                                    <div class="row mb-2">
                                        <div class="col-sm-5">
                                            <div class="search-box mr-2 mb-2 d-inline-block">
                                                <div class="position-relative">
                                                    <input type="text" name="search" class="form-control" placeholder="Nhập tên bệnh nhân">
                                                    <i class="bx bx-search-alt search-icon"></i>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                                <i class="bx bx-search-alt search-icon font-size-16 align-middle mr-2"></i> Tìm kiếm
                                            </button>
                                        </div>

                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">STT</th>
                                                <th>Mã</th>
                                                <th>Tên bệnh nhân</th>
                                                <th>Dịch vụ khám</th>
                                                <th>Bác sĩ</th>
                                                <th>Ngày bắt đầu</th>
                                                <th>Ngày kết thúc</th>
                                                <th>Tổng tiền (VNĐ)</th>
                                                <th>Trạng thái</th>
                                                <th class="text-center">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php ($stt = 1)
                                            @foreach ($service_vouchers as $service_voucher)
                                                <tr>
                                                    <td class="text-center">{{ $stt++ }}</td>
                                                    <td>{{ $service_voucher->code }}</td>
                                                    <td>
                                                        {{ $service_voucher->patient->name }}
                                                    </td>
                                                    <td>
                                                        {{ $service_voucher->medicalService->name }}
                                                    </td>
                                                    <td>{{ $service_voucher->user->name }}</td>
                                                    <td>{{ date("d-m-Y", strtotime($service_voucher->start_date)) }}</td>
                                                    <td>{{ date("d-m-Y", strtotime($service_voucher->end_date)) }}</td>
                                                    <td>{{ number_format($service_voucher->total_money, 0, ',', '.') }}</td>
                                                    <td>
                                                        @if ($service_voucher->payment_status)
                                                            <label class="btn btn-success waves-effect waves-light">
                                                                <i class="bx bx-check-double font-size-16 align-middle mr-2"></i> Đã thanh toán
                                                            </label>
                                                        @else
                                                            <label class="btn btn-warning waves-effect waves-light font-size-12">Chưa thanh toán</label>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <ul class="list-inline font-size-20 contact-links mb-0">
                                                            @if ($service_voucher->payment_status == 0)
                                                                @can('Xác nhận thanh toán phiếu dịch vụ')
                                                                <li class="list-inline-item px">
                                                                    <form method="post" action="{{ route('cashier_service_vouchers.confirm-payment', $service_voucher->id) }}">
                                                                        @csrf
                                                                        
                                                                        <button type="submit" data-toggle="tooltip" data-placement="top" title="Xác nhận thanh toán" class="border-0 bg-white"><i class="bx bxs-calendar-check text-success"></i></button>
                                                                    </form>
                                                                </li>
                                                                @endcan
                                                            @endif

                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{ $service_vouchers->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        
    </div>
@endsection