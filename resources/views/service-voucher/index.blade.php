@extends('layouts.default')

@section('title') Quản lý phiếu dịch vụ @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Danh sách phiếu dịch vụ</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Quản lý" data-toggle="tooltip" data-placement="top">Quản lý</a></li>
                                    <li class="breadcrumb-item active">Danh sách phiếu dịch vụ</li>
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
                                <form method="GET" action="{{ route('service_vouchers.index') }}">
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

                                        @can('Thêm phiếu dịch vụ')
                                        <div class="col-sm-7">
                                            <div class="text-sm-right">
                                                <a href="{{ route('service_vouchers.create') }}" class="text-white btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"></i> Thêm phiếu dịch vụ</a>
                                            </div>
                                        </div><!-- end col-->
                                        @endcan
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
                                                <th>Thanh toán</th>
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
                                                        @if ($service_voucher->status)
                                                            <label class="btn btn-success waves-effect waves-light">
                                                                <i class="bx bx-check-double font-size-16 align-middle mr-2"></i> Đã khám
                                                            </label>
                                                        @else
                                                            <label class="btn btn-warning waves-effect waves-light font-size-12">Chưa khám xong</label>
                                                        @endif
                                                    </td>
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
                                                            @can('Xem thông tin phiếu dịch vụ')
                                                            <li class="list-inline-item px">
                                                                <a href="{{ route('service_vouchers.show', $service_voucher->id) }}" data-toggle="tooltip" data-placement="top" title="Xem thông tin"><i class="bx bx-user-circle text-success"></i></a>
                                                            </li>
                                                            @endcan

                                                            @can('In phiếu dịch vụ')
                                                            <li class="list-inline-item px">
                                                                <a href="{{ route('service_vouchers.print', $service_voucher->id) }}" data-toggle="tooltip" data-placement="top" title="In phiếu dịch vụ"><i class="bx bx-printer text-success"></i></a>
                                                            </li>
                                                            @endcan

                                                            @if ($service_voucher->status == 0)
                                                                @if ($service_voucher->payment_status == 1)
                                                                    @can('Hoàn thành khám phiếu dịch vụ')
                                                                    <li class="list-inline-item px">
                                                                        <form method="post" action="{{ route('service_vouchers.complete-examination', $service_voucher->id) }}">
                                                                            @csrf

                                                                            <button type="submit" data-toggle="tooltip" data-placement="top" title="Hoàn thành khám" class="border-0 bg-white"><i class="bx bx-check-double text-success"></i></button>
                                                                        </form>
                                                                    </li>
                                                                    @endcan

                                                                    @can('Kết luận khám phiếu dịch vụ')
                                                                    <li class="list-inline-item px">
                                                                        <a href="{{ route('service_voucher_details.create', ['service_voucher_id' =>  $service_voucher->id]) }}" data-toggle="tooltip" data-placement="top" title="Kết luận khám"><i class="bx bxs-calendar-check text-success"></i></a>
                                                                    </li>
                                                                    @endcan
                                                                @endif

                                                                @if ($service_voucher->payment_status == 0)
                                                                    @can('Chỉnh sửa phiếu dịch vụ')
                                                                    <li class="list-inline-item px">
                                                                        <a href="{{ route('service_vouchers.edit', $service_voucher->id) }}" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="mdi mdi-pencil text-success"></i></a>
                                                                    </li>
                                                                    @endcan

                                                                    @can('Xóa phiếu dịch vụ')
                                                                    <li class="list-inline-item px">
                                                                        <form method="post" action="{{ route('service_vouchers.destroy', $service_voucher->id) }}">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            
                                                                            <button type="submit" data-toggle="tooltip" data-placement="top" title="Xóa" class="border-0 bg-white"><i class="mdi mdi-trash-can text-danger"></i></button>
                                                                        </form>
                                                                    </li>
                                                                    @endcan
                                                                @endif
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