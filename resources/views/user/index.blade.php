@extends('layouts.default')

@section('title') Quản lý tài khoản @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Danh sách tài khoản</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">Cài đặt</li>
                                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}" title="Cài đặt" data-toggle="tooltip" data-placement="top">Tài khoản</a></li>
                                    <li class="breadcrumb-item active">Danh sách tài khoản</li>
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
                                <form method="GET" action="{{ route('users.index') }}">
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

                                        @can('Thêm tài khoản')
                                        <div class="col-sm-7">
                                            <div class="text-sm-right">
                                                <a href="{{ route('users.create') }}" class="text-white btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"></i> Thêm tài khoản</a>
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
                                                <th>Ảnh đại diện</th>
                                                <th>Họ và tên</th>
                                                <th>Vai trò</th>
                                                <th>Giới tính</th>
                                                <th>Số điện thoại</th>
                                                <th>Ngày sinh</th>
                                                <th>Địa chỉ</th>
                                                <th class="text-center">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php ($stt = 1)
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td class="text-center">{{ $stt++ }}</td>
                                                    <td>{{ $user->code }}</td>
                                                    <td>
                                                        @if ($user->avatar)
                                                            <div>
                                                                <img class="rounded-circle avatar-xs" src="{{ asset($user->avatar) }}" alt="">
                                                            </div>
                                                        @else
                                                            <div class="avatar-xs">
                                                                <span class="avatar-title rounded-circle text-uppercase">
                                                                    {{ substr($user->name, 0, 1) }}
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>
                                                        @foreach ($user->roles as $role)
                                                            <span class="badge badge-dark text-white">{{ $role->name }}</span>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $user->gender }}</td>
                                                    <td>{{ $user->phone }}</td>
                                                    <td>{{ date("d-m-Y", strtotime($user->birthday)) }}</td>
                                                    <td>{{ $user->address }}</td>
                                                    <td class="text-center">
                                                        @if ($user->id != 1)
                                                        <ul class="list-inline font-size-20 contact-links mb-0">
                                                            @can('Chỉnh sửa tài khoản')
                                                            <li class="list-inline-item px">
                                                                <a href="{{ route('users.edit', $user->id) }}" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="mdi mdi-pencil text-success"></i></a>
                                                            </li>
                                                            @endcan

                                                            @can('Xóa tài khoản')
                                                            <li class="list-inline-item px">
                                                                <form method="post" action="{{ route('users.destroy', $user->id) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    
                                                                    <button type="submit" data-toggle="tooltip" data-placement="top" title="Xóa" class="border-0 bg-white"><i class="mdi mdi-trash-can text-danger"></i></button>
                                                                </form>
                                                            </li>
                                                            @endcan
                                                        </ul>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->



    </div>
@endsection