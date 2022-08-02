@extends('layouts.default')

@section('title') Quản lý trạm @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Danh sách trạm</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Quản lý" data-toggle="tooltip" data-placement="top">Quản lý</a></li>
                                    <li class="breadcrumb-item active">Danh sách trạm</li>
                                </ol>
                            </div>
                        </div>

                        <img src="{{ asset('images/logo.png') }}" alt="" class="w-100">
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" action="{{ route('stations.index') }}">
                                    <div class="row mb-2">
                                        <div class="col-sm-5">
                                            <div class="search-box mr-2 mb-2 d-inline-block">
                                                <div class="position-relative">
                                                    <input type="text" name="search" class="form-control" placeholder="Nhập tên trạm">
                                                    <i class="bx bx-search-alt search-icon"></i>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                                <i class="bx bx-search-alt search-icon font-size-16 align-middle mr-2"></i> Tìm kiếm
                                            </button>
                                        </div>
                                        
                                        {{-- @can('Thêm trạm') --}}
                                        <div class="col-sm-7">
                                            <div class="text-sm-right">
                                                <a href="{{ route('stations.create') }}" class="text-white btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"></i> Thêm trạm</a>
                                            </div>
                                        </div><!-- end col-->
                                        {{-- @endcan --}}

                                        <div class="col-sm-12">
                                            <a href="{{ route('station.system-tree') }}" class="text-white btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-chart-tree"></i> Cây hệ thống</a>
                                        </div>
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap">
                                        <thead class="thead-light">
                                            <tr>
                                                <th style="width: 70px;" class="text-center">STT</th>
                                                <th>Tên trạm</th>
                                                <th>Số điện thoại</th>
                                                <th>Địa chỉ</th>
                                                <th>Đơn vị BĐKT</th>
                                                <th class="text-center">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php ($stt = 1)
                                            @foreach ($stations as $station)
                                                <tr>
                                                    <td class="text-center">{{ $stt++ }}</td>
                                                    <td><a href="{{ route('stations.show', $station->id) }}">{{ $station->name }}</a></td>
                                                    <td>{{ $station->phone_number }}</td>
                                                    <td>{{ $station->address }}</td>
                                                    <td>{{ $station->unit->name }}</td>
                                                    <td class="text-center">
                                                        <ul class="list-inline font-size-20 contact-links mb-0">
                                                            {{-- @can('Chỉnh sửa trạm') --}}
                                                            <li class="list-inline-item px">
                                                                <a href="{{ route('stations.edit', $station->id) }}" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="mdi mdi-pencil text-success"></i></a>
                                                            </li>
                                                            {{-- @endcan --}}

                                                            {{-- @can('Xóa trạm') --}}
                                                            <li class="list-inline-item px">
                                                                <form method="post" action="{{ route('stations.destroy', $station->id) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    
                                                                    <button type="submit" data-toggle="tooltip" data-placement="top" title="Xóa" class="border-0 bg-white"><i class="mdi mdi-trash-can text-danger"></i></button>
                                                                </form>
                                                            </li>
                                                            {{-- @endcan --}}
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{ $stations->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


       
    </div>
@endsection