@extends('layouts.default')

@section('title') Thông tin cá nhân @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Thông tin cá nhân</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Thông tin cá nhân" data-toggle="tooltip" data-placement="top">Thông tin cá nhân</a></li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-4">
                        <div class="card overflow-hidden">
                            <div class="bg-soft-primary">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-3">
                                            <h5 class="text-primary">Chào mừng trở lại!</h5>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{ asset('images\profile-img.png') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            @if ($user->avatar)
                                            <img src="{{ asset($user->avatar) }}" alt="" class="img-thumbnail rounded-circle">
                                            @else
                                            <div class="avatar-md">
                                                <span class="avatar-title rounded-circle text-uppercase">
                                                    {{ substr($user->name, 0, 1) }}
                                                </span>
                                            </div>
                                            @endif
                                        </div>
                                        <h5 class="font-size-15 text-truncate">{{ $user->name }}</h5>
                                        <p class="text-muted mb-0 text-truncate">
                                            @foreach ($user->roles as $role)
                                            <span class="badge badge-dark text-white">{{ $role->name }}</span>
                                            @endforeach
                                        </p>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="pt-4">
                                         
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="font-size-15">Mã</h5>
                                                    <p class="text-muted mb-0">{{ $user->code }}</p>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="font-size-15">Giới tính</h5>
                                                    <p class="text-muted mb-0">{{ $user->gender }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->

                        
                    </div>         
                    
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Thông tin cá nhân</h4>

                                <div class="table-responsive">
                                    <table class="table table-nowrap mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Họ và tên :</th>
                                                <td>{{ $user->name }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Số điện thoại :</th>
                                                <td>{{ $user->phone }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">E-mail :</th>
                                                <td>{{ $user->email }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Ngày sinh :</th>
                                                <td>{{ date("d-m-Y", strtotime($user->birthday)) }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Địa chỉ :</th>
                                                <td>{{ $user->address }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


    
    </div>
@endsection