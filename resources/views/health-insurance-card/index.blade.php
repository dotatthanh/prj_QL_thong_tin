@extends('layouts.default')

@section('title') Quản lý thẻ BHYT @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Danh sách thẻ BHYT</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Quản lý" data-toggle="tooltip" data-placement="top">Quản lý</a></li>
                                    <li class="breadcrumb-item active">Danh sách thẻ BHYT</li>
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
                                <form method="GET" action="{{ route('health_insurance_cards.index') }}">
                                    <div class="row mb-2">
                                        <div class="col-sm-5">
                                            <div class="search-box mr-2 mb-2 d-inline-block">
                                                <div class="position-relative">
                                                    <input type="text" name="search" class="form-control" placeholder="Nhập họ và tên">
                                                    <i class="bx bx-search-alt search-icon"></i>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                                <i class="bx bx-search-alt search-icon font-size-16 align-middle mr-2"></i> Tìm kiếm
                                            </button>
                                        </div>

                                        @can('Thêm thẻ BHYT')
                                        <div class="col-sm-7">
                                            <div class="text-sm-right">
                                                <a href="{{ route('health_insurance_cards.create') }}" class="text-white btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"></i> Thêm thẻ BHYT</a>
                                            </div>
                                        </div><!-- end col-->
                                        @endcan
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap">
                                        <thead class="thead-light">
                                            <tr>
                                                <th style="width: 70px;" class="text-center">STT</th>
                                                <th>Mã</th>
                                                <th>Họ và tên</th>
                                                <th>Nơi đăng ký khám</th>
                                                <th>Giá trị sử dụng</th>
                                                <th>Mã số</th>
                                                <th>Ngày cấp</th>
                                                <th>Nơi cấp</th>
                                                <th class="text-center">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php ($stt = 1)
                                            @foreach ($health_insurance_cards as $health_insurance_card)
                                                <tr>
                                                    <td class="text-center">{{ $stt++ }}</td>
                                                    <td>{{ $health_insurance_card->code }}</td>
                                                    <td>{{ $health_insurance_card->patient->name }}</td>
                                                    <td>
                                                        {{ $health_insurance_card->hospital }}
                                                    </td>
                                                    <td>{{ date("d-m-Y", strtotime($health_insurance_card->use_value)) }}</td>
                                                    <td>{{ $health_insurance_card->id_card }}</td>
                                                    <td>{{ date("d-m-Y", strtotime($health_insurance_card->date_of_issue)) }}</td>
                                                    <td>{{ $health_insurance_card->issued_by }}</td>
                                                    <td class="text-center">
                                                        <ul class="list-inline font-size-20 contact-links mb-0">
                                                            @can('Chỉnh sửa thẻ BHYT')
                                                            <li class="list-inline-item px">
                                                                <a href="{{ route('health_insurance_cards.edit', $health_insurance_card->id) }}" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="mdi mdi-pencil text-success"></i></a>
                                                            </li>
                                                            @endcan

                                                            @can('Xóa thẻ BHYT')
                                                            <li class="list-inline-item px">
                                                                <form method="post" action="{{ route('health_insurance_cards.destroy', $health_insurance_card->id) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    
                                                                    <button type="submit" data-toggle="tooltip" data-placement="top" title="Xóa" class="border-0 bg-white"><i class="mdi mdi-trash-can text-danger"></i></button>
                                                                </form>
                                                            </li>
                                                            @endcan
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{ $health_insurance_cards->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        
    </div>
@endsection