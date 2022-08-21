@extends('layouts.default')

@section('title') Tìm kiếm @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <img src="{{ asset('images/logo.png') }}" alt="" class="w-100 mb-5">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Tìm kiếm</h4>

                            {{-- <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Trang chủ</a></li>
                                    <li class="breadcrumb-item active">Tìm kiếm</li>
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
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Đơn vị BĐKT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($station)
                                @php ($stt = 1)
                                <tr>
                                    <td class="text-center">{{ $stt++ }}</td>
                                    <td><a href="{{ route('stations.show', $station->id) }}">{{ $station->name }}</a></td>
                                    <td>{{ $station->phone_number }}</td>
                                    <td>{{ $station->address }}</td>
                                    <td>{{ $station->unit->name }}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    @if (count($transmission_streams) > 0)
                    <div class="table-responsive mt-5">
                        <table class="table table-bordered table-centered table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th rowspan="2" class="text-center">STT</th>
                                    <th colspan="4" class="text-center">Toạ độ truyền dẫn tại trạm</th>
                                    <th rowspan="2">Nhãn luồng</th>
                                    <th rowspan="2">Dịch vụ</th>
                                    <th rowspan="2">Loại tín hiệu</th>
                                    <th colspan="4" class="text-center">Toạ độ truyền dẫn đầu xa</th>
                                    <th rowspan="2">Ghi chú</th>
                                    <th rowspan="2">Ngày cập nhật</th>
                                </tr>
                                <tr>
                                    <th>Thiết bị</th>
                                    <th>Tên card</th>
                                    <th>Toạ độ</th>
                                    <th>Port</th>
                                    <th>Trạm</th>
                                    <th>Thiết bị</th>
                                    <th>Toạ độ</th>
                                    <th>Port</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($stt = 1)
                                @foreach ($transmission_streams as $transmission_stream)
                                <tr>
                                    <td class="text-center">{{ $stt++ }}</td>
                                    <td>
                                        {{ $transmission_stream->Device->name }}
                                    </td>
                                    <td>{{ $transmission_stream->name_card }}</td>
                                    <td>{{ $transmission_stream->coordinates_origin }}</td>
                                    <td>{{ $transmission_stream->port_origin }}</td>
                                    <td>{{ $transmission_stream->thread_label }}</td>
                                    <td>{{ $transmission_stream->service }}</td>
                                    <td>{{ $transmission_stream->signal_type }}</td>
                                    <td>{{ $transmission_stream->station }}</td>
                                    <td>{{ $transmission_stream->device }}</td>
                                    <td>{{ $transmission_stream->coordinates_remote }}</td>
                                    <td>{{ $transmission_stream->port_remote }}</td>
                                    <td>{{ $transmission_stream->note }}</td>
                                    <td>{{ date('d/m/Y', strtotime($transmission_stream->updated_at)) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    @if (count($tv_streams) > 0)
                    <div class="table-responsive mt-5">
                        <table class="table table-bordered table-centered table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th rowspan="2" class="text-center">STT</th>
                                    <th colspan="4" class="text-center">Toạ độ truyền dẫn tại trạm</th>
                                    <th rowspan="2">Nhãn luồng</th>
                                    <th rowspan="2">Dịch vụ</th>
                                    <th rowspan="2">Loại tín hiệu</th>
                                    <th colspan="3" class="text-center">Truyền dẫn tại trạm</th>
                                    <th colspan="4" class="text-center">Toạ độ truyền dẫn đầu xa</th>
                                    <th rowspan="2">Ghi chú</th>
                                    <th rowspan="2">Ngày cập nhật</th>
                                </tr>
                                <tr>
                                    <th>Thiết bị</th>
                                    <th>Tên card</th>
                                    <th>Toạ độ</th>
                                    <th>Port</th>
                                    <th>Thiết bị</th>
                                    <th>Toạ độ</th>
                                    <th>Port</th>
                                    <th>Trạm</th>
                                    <th>Thiết bị</th>
                                    <th>Toạ độ</th>
                                    <th>Port</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($stt = 1)
                                @foreach ($tv_streams as $transmission_stream)
                                <tr>
                                    <td class="text-center">{{ $stt++ }}</td>
                                    <td>
                                        {{ $transmission_stream->Device->name }}
                                    </td>
                                    <td>{{ $transmission_stream->name_card }}</td>
                                    <td>{{ $transmission_stream->coordinates_origin }}</td>
                                    <td>{{ $transmission_stream->port_origin }}</td>
                                    <td>{{ $transmission_stream->thread_label }}</td>
                                    <td>{{ $transmission_stream->service }}</td>
                                    <td>{{ $transmission_stream->signal_type }}</td>
                                    <td>{{ $transmission_stream->device_station }}</td>
                                    <td>{{ $transmission_stream->coordinates_station }}</td>
                                    <td>{{ $transmission_stream->port_station }}</td>
                                    <td>{{ $transmission_stream->station }}</td>
                                    <td>{{ $transmission_stream->device }}</td>
                                    <td>{{ $transmission_stream->coordinates_remote }}</td>
                                    <td>{{ $transmission_stream->port_remote }}</td>
                                    <td>{{ $transmission_stream->note }}</td>
                                    <td>{{ date('d/m/Y', strtotime($transmission_stream->updated_at)) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
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