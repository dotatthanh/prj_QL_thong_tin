@extends('layouts.default')

@section('title') Quản lý luồng TH-TDL @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Danh sách luồng TH-TDL</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Quản lý" data-toggle="tooltip" data-placement="top">Quản lý</a></li>
                                    <li class="breadcrumb-item active">Danh sách luồng TH-TDL</li>
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
                                <form method="GET" action="{{ route('tv_streams.index') }}">
                                    <div class="row mb-2">
                                        <div class="col-sm-5">
                                            <div class="search-box mr-2 mb-2 d-inline-block">
                                                <div class="position-relative">
                                                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm luồng" value="{{ $request->search }}">
                                                    <input type="text" name="device_id" hidden value="{{ $request->device_id }}">
                                                    <i class="bx bx-search-alt search-icon"></i>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                                <i class="bx bx-search-alt search-icon font-size-16 align-middle mr-2"></i> Tìm kiếm
                                            </button>
                                        </div>
                                        
                                        {{-- @can('Thêm luồng truyền dẫn') --}}
                                        @if (isset($request->device_id))
                                        <div class="col-sm-7">
                                            <div class="text-sm-right">
                                                <button type="button" class="text-white btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="mdi mdi-plus mr-1"></i> Thêm Card thiết bị</button>

                                            </div>
                                        </div>
                                        @endif
                                        {{-- @endcan --}}
                                    </div>
                                </form>

                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Thêm Card</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form method="GET" action="{{ route('tv_streams.create') }}">
                                                <div class="modal-body">
                                                    @if (isset($request->device_id))
                                                        <input hidden type="text" name="device_id" value="{{ $request->device_id }}">
                                                    @endif

                                                    <div class="form-group row">
                                                        <label for="name_card" class="col-sm-2 col-form-label">Tên card :</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="name_card" placeholder="Nhập tên card" name="name_card">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="port" class="col-sm-2 col-form-label">Port :</label>
                                                        <div class="col-sm-10">
                                                            <input required type="number" min="1" class="form-control" id="port" placeholder="Nhập port" name="port_origin">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="signal_type" class="col-sm-2 col-form-label">Loại tín hiệu :</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="signal_type" placeholder="Nhập loại tín hiệu" name="signal_type">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="coordinates" class="col-sm-2 col-form-label">Toạ độ :</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="coordinates" placeholder="Nhập toạ độ" name="coordinates_origin">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="text-white btn btn-success waves-effect waves-light mb-2 mr-2">Thêm</button>
                                                    {{-- <a href="{{ route('tv_streams.create') }}" class="text-white btn btn-success waves-effect waves-light mb-2 mr-2">Thêm</a> --}}
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-lg-2">
                                        @if (!empty($dataList))
                                            <p class="parent">{{ !empty($dataList['name']) ? $dataList['name']: '' }}</p>
                                            <ul class="wtree">
                                                @foreach ($dataList['childs'] as $lv2)
                                                    <li>
                                                        <span>{{ !empty($lv2['name']) ? $lv2['name']: '' }}</span>

                                                        @if ($lv2['count_child'] > 0)
                                                            <ul>
                                                                @foreach ($lv2['childs'] as $lv3)
                                                                    <li id="li-unit-{{ $lv3['id'] }}" class="close-el">
                                                                        <span>
                                                                            @if ($lv3['count_child'] > 0)
                                                                                <i class="fa fa-plus-circle extend-level" aria-hidden="true" data-id="{{ $lv3['id'] }}" onclick="extendLevel({{ $lv3['id'] }})" id="i-{{ $lv3['id'] }}"></i>
                                                                            @endif
                                                                            {{ !empty($lv3['name']) ? $lv3['name']: '' }}
                                                                        </span>
                                                                    </li>
                                                                @endforeach

                                                                @foreach ($lv2['station_childs'] as $lv3_station)
                                                                    <li id="li-station-{{ $lv3_station['id'] }}" class="close-el">
                                                                        <span>
                                                                            <i class="fa fa-plus-circle extend-level" aria-hidden="true" data-id="{{ $lv3_station['id'] }}" onclick="extendDevice({{ $lv3_station['id'] }})" id="i-{{ $lv3_station['id'] }}"></i>
                                                                            {{ !empty($lv3_station['name']) ? $lv3_station['name']: '' }}
                                                                        </span>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>

                                    <div class="col-lg-10">
                                        <div class="table-responsive">
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
                                                        <th rowspan="2">Thao tác</th>
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
                                                            <td class="text-center">
                                                                <ul class="list-inline font-size-20 contact-links mb-0">
                                                                    {{-- @can('Chỉnh sửa luồng truyền dẫn') --}}
                                                                    <li class="list-inline-item px">
                                                                        <button type="button" class="mdi mdi-pencil text-success btn" data-toggle="modal" data-target="#modal-edit{{ $transmission_stream->id }}"></button>
                                                                    </li>
                                                                    {{-- @endcan --}}
                                                                </ul>

<div class="modal fade" id="modal-edit{{ $transmission_stream->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Sửa Card</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" action="{{ route('tv_streams.update', $transmission_stream->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-centered table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th colspan="4" class="text-center">Toạ độ truyền dẫn tại trạm</th>
                                    <th rowspan="2">Nhãn luồng</th>
                                    <th rowspan="2">Dịch vụ</th>
                                    <th rowspan="2">Loại tín hiệu</th>
                                    <th colspan="3" class="text-center">Truyền dẫn tại trạm</th>
                                    <th colspan="4" class="text-center">Toạ độ truyền dẫn đầu xa</th>
                                    <th rowspan="2">Ghi chú</th>
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
                                <tr>
                                    <td>
                                        {{ $transmission_stream->Device->name }}
                                    </td>
                                    <td>{{ $transmission_stream->name_card }}</td>
                                    <td>{{ $transmission_stream->coordinates_origin }}</td>
                                    <td>{{ $transmission_stream->port_origin }}</td>
                                    <td><input style="width: 135px;" required type="text" class="form-control" placeholder="Nhập nhãn luồng" name="thread_label" value="{{ $transmission_stream->thread_label }}"></td>
                                    <td><input style="width: 135px;" required type="text" class="form-control" placeholder="Nhập dịch vụ" name="service" value="{{ $transmission_stream->service }}"></td>
                                    <td>{{ $transmission_stream->signal_type }}</td>
                                    <td><input style="width: 135px;" required type="text" class="form-control" placeholder="Nhập thiết bị" name="device_station" value="{{ $transmission_stream->device_station }}"></td>
                                    <td><input style="width: 135px;" required type="text" class="form-control" placeholder="Nhập toạ độ" name="coordinates_station" value="{{ $transmission_stream->coordinates_station }}"></td>
                                    <td><input style="width: 135px;" required type="number" min="1" class="form-control" placeholder="Nhập port" name="port_station" value="{{ $transmission_stream->port_station }}"></td>
                                    <td><input style="width: 135px;" required type="text" class="form-control" placeholder="Nhập port" name="station" value="{{ $transmission_stream->station }}"></td>
                                    <td><input style="width: 135px;" required type="text" class="form-control" placeholder="Nhập port" name="device" value="{{ $transmission_stream->device }}"></td>
                                    <td><input style="width: 135px;" required type="text" class="form-control" placeholder="Nhập port" name="coordinates_remote" value="{{ $transmission_stream->coordinates_remote }}"></td>
                                    <td><input style="width: 135px;" required type="number" min="1" class="form-control" placeholder="Nhập port" name="port_remote" value="{{ $transmission_stream->port_remote }}"></td>
                                    <td><input style="width: 135px;" required type="text" class="form-control" placeholder="Nhập port" name="note" value="{{ $transmission_stream->note }}"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="text-white btn btn-success waves-effect waves-light mb-2 mr-2">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        @if (isset($request->device_id) || isset($request->device_id))
                                            <div class="mt-3">
                                                {{ $tv_streams->links() }}
                                            </div>
                                        @endif
                                        <a href="{{ route('tv_streams.print', $request->all()) }}" class="d-inline-block text-white btn btn-success btn-rounded waves-effect waves-light mt-2 mb-2"><i class="bx bx-printer mr-1"></i> In file quản lý</a>
                                    </div>
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


@push('js')
    <script type="text/javascript">
        function extendLevel(parentId) {
            var li = $("#li-unit-" + parentId);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if (li.hasClass("close-el")) {
                $.ajax({
                    url: "/station/get-unit-child-list",
                    type: "POST",
                    data: {
                        id: parentId
                    },
                    success: function (data) {
                        if (data.status == 1) {
                            $("#i-" + parentId).addClass('fa-minus-circle').removeClass('fa-plus-circle');
                            $(li).addClass("open-el").removeClass("close-el");

                            var html = `<ul>`;
                            var button_extend = "";
                            $.each(data.data_unit, function( index, value ) {
                                if (value.count_child > 0) {
                                    button_extend = `<i class="fa fa-plus-circle extend-level" aria-hidden="true" data-id="`+ value.id +`" onclick="extendLevel(`+ value.id +`)" id="i-`+ value.id +`"></i>`;
                                }
                                html += `<li id="li-unit-`+ value.id +`" class="close-el">
                                    <span>`+ button_extend + ` ` + value.name + ` </span>
                                    </li>`;
                            });

                            $.each(data.data_station, function( index, value ) {
                                html += `<li id="li-station-`+ value.id +`" class="close-el">
                                    <span> <i class="fa fa-plus-circle extend-level" aria-hidden="true" data-id="${value.id}" onclick="extendDevice(${value.id})" id="i-${value.id}"></i> Trạm: ` + value.name + ` </span>
                                    </li>`;
                            });

                            html += `</ul>`;
                            li.append(html);
                        }
                    },
                });
            } else {
                $("#i-" + parentId).addClass('fa-plus-circle').removeClass('fa-minus-circle');
                $(li).addClass("close-el").removeClass("open-el");
                $("#li-unit-" + parentId + " ul").remove();
            }
        }

        function extendDevice(stationId) {
            var li = $("#li-station-" + stationId);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if (li.hasClass("close-el")) {
                $.ajax({
                    url: "/device/get-device-television-by-station",
                    type: "POST",
                    data: {
                        id: stationId
                    },
                    success: function (data) {
                        $("#i-" + stationId).addClass('fa-minus-circle').removeClass('fa-plus-circle');
                        $(li).addClass("open-el").removeClass("close-el");

                        var html = `<ul>`;
                        if (data.count > 0) {
                            $.each(data.devices, function( index, value ) {
                                html += `<li id="li-station-${value.id}" class="close-el">
                                    <a href="/tv_streams?device_id=${value.id}"> ${value.name}</a>
                                </li>`;
                            });
                        }

                        html += `</ul>`;
                        li.append(html);
                    },
                });
            } else {
                $("#i-" + stationId).addClass('fa-plus-circle').removeClass('fa-minus-circle');
                $(li).addClass("close-el").removeClass("open-el");
                $("#li-station-" + stationId + " ul").remove();
            }
        }
    </script>
@endpush

@push('css')
    <style type="text/css">
        .extend-level {
            float: left;
            padding-right: 5px;
            margin-top: 2px;
            font-size: 18px;
            cursor: pointer;
            color: #4c4848 !important;
        }
        ul {
            padding-left: 20px;
        }
        .parent {
            display: block;
             border: 1px solid #4c4848; 
            padding-left: 10px;
            color: #4c4848;
            text-decoration: none;
            /*width: 250px;*/
            font-size: 14px;
        }

        .wtree li {
            list-style-type: none;
            margin: 10px 0 10px 10px;
            position: relative;
        }
        .wtree li:before {
            content: "";
            position: absolute;
            top: -10px;
            left: -20px;
            border-left: 1px solid #4c4848;
            border-bottom: 1px solid #4c4848;
            width: 20px;
            height: 15px;
        }
        .wtree li:after {
            position: absolute;
            content: "";
            top: 5px;
            left: -20px;
            border-left: 1px solid #4c4848;
            border-top: 1px solid #4c4848;
            width: 20px;
            height: 100%;
        }
        .wtree li:last-child:after {
        display: none;
        }
        .wtree li span, .wtree li a {
            display: block;
            color: #4c4848;
            text-decoration: none;
            width: 250px;
            padding-left: 10px;
        }
        .wtree li span:hover + ul li:after, .wtree li span:hover + ul li:before, .wtree li span:focus + ul li:after, .wtree li span:focus + ul li:before {
            border-color: #4c4848;
        }
    </style>
@endpush