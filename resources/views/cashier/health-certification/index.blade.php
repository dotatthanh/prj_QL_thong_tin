@extends('layouts.default')

@section('title') Thu ngân giấy khám bệnh @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Danh sách thu ngân giấy khám bệnh</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Quản lý" data-toggle="tooltip" data-placement="top">Quản lý</a></li>
                                    <li class="breadcrumb-item active">Thu ngân</li>
                                    <li class="breadcrumb-item active">Danh sách thu ngân giấy khám bệnh</li>
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
                                <form method="GET" action="{{ route('cashier_health_certifications.index') }}">
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
                                                <th>Tiêu đề</th>
                                                <th>Phòng khám</th>
                                                <th>Bác sĩ</th>
                                                <th>Ngày</th>
                                                <th>Tổng tiền (VNĐ)</th>
                                                <th>Trạng thái</th>
                                                <th class="text-center">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($health_certifications as $health_certification)
                                                <tr>
                                                    <td class="text-center">{{ $health_certification->number }}</td>
                                                    <td>{{ $health_certification->code }}</td>
                                                    <td>
                                                        {{ $health_certification->patient->name }}
                                                    </td>
                                                    <td>
                                                        {{ $health_certification->title }}
                                                    </td>
                                                    <td>{{ $health_certification->consultingRoom->name }}</td>
                                                    <td>{{ $health_certification->user->name }}</td>
                                                    <td>{{ date("d-m-Y", strtotime($health_certification->created_at)) }}</td>
                                                    <td>{{ number_format($health_certification->total_money, 0, ',', '.') }}</td>
                                                    <td>
                                                        @if ($health_certification->payment_status)
                                                            <label class="btn btn-success waves-effect waves-light">
                                                                <i class="bx bx-check-double font-size-16 align-middle mr-2"></i> Đã thanh toán
                                                            </label>
                                                        @else
                                                            <label class="btn btn-warning waves-effect waves-light font-size-12">Chưa thanh toán</label>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <ul class="list-inline font-size-20 contact-links mb-0">
                                                            @if ($health_certification->payment_status == 0)
                                                                @can('Xác nhận thanh toán giấy khám bệnh')
                                                                <li class="list-inline-item px">
                                                                    <form method="post" action="{{ route('cashier_health_certifications.confirm-payment', $health_certification->id) }}">
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

                                {{ $health_certifications->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        
    </div>
@endsection