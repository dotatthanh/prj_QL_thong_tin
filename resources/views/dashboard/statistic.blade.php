@extends('layouts.default')

@section('title') Thống kê @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <img src="{{ asset('images/logo.png') }}" alt="" class="w-100 mb-5">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Thống kê</h4>

                            {{-- <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Trang chủ</a></li>
                                    <li class="breadcrumb-item active">Thống kê</li>
                                </ol>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="table-responsive mt-5">
                        <table class="table table-centered table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 70px;" class="text-center">STT</th>
                                    <th>Tên trạm</th>
                                    <th class="text-center">Thiết bị truyền dẫn</th>
                                    <th class="text-center">Luồng TD</th>
                                    <th class="text-center">Thiết bị truyền số liệu - truyền hình truyền số liệu</th>
                                    <th class="text-center">Luồng TH - TSL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($stt = 1)
                                @foreach ($stations as $station)
                                <tr>
                                    <td class="text-center">{{ $stt++ }}</td>
                                    <td>{{ $station->name }}</td>
                                    <td class="text-center">{{ $station->tranmissionStreamDevice }}</td>
                                    <td class="text-center">{{ $station->tranmissionStreamUsed }}/{{ $station->tranmissionStream->count() }}</td>
                                    <td class="text-center">{{ $station->tvStreamDevice }}</td>
                                    <td class="text-center">{{ $station->tvStreamUsed }}/{{ $station->tvStream->count() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $stations->links() }}
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