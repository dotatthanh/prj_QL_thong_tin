@extends('layouts.default')

@section('title') Quản lý luồng TH-TSL @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <img src="{{ asset('images/logo.png') }}" alt="" class="w-100 mb-5">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Danh sách luồng TH-TSL</h4>

                            {{-- <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Quản lý" data-toggle="tooltip" data-placement="top">Quản lý</a></li>
                                    <li class="breadcrumb-item active">Danh sách luồng TH-TSL</li>
                                </ol>
                            </div> --}}
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
                                                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm nhãn luồng" value="{{ $request->search }}">
                                                    <input type="text" name="device_id" hidden value="{{ $request->device_id }}">
                                                    <i class="bx bx-search-alt search-icon"></i>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                                <i class="bx bx-search-alt search-icon font-size-16 align-middle mr-2"></i> Tìm kiếm
                                            </button>
                                        </div>
                                        
                                        @can('Thêm luồng TH-TSL')
                                        @if (isset($request->device_id))
                                        <div class="col-sm-7">
                                            <div class="text-sm-right">
                                                <button type="button" class="text-white btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="mdi mdi-plus mr-1"></i> Thêm Card thiết bị</button>

                                            </div>
                                        </div>
                                        @endif
                                        @endcan
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
                                                        <label for="name_card" class="col-sm-2 col-form-label">Tên card : <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="name_card" placeholder="Nhập tên card" name="name_card">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="port" class="col-sm-2 col-form-label">Port : <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input required type="number" min="1" class="form-control" id="port" placeholder="Nhập port" name="port_origin">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="signal_type" class="col-sm-2 col-form-label">Loại tín hiệu : <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="signal_type" placeholder="Nhập loại tín hiệu" name="signal_type">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="coordinates" class="col-sm-2 col-form-label">Toạ độ : <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="coordinates" placeholder="Nhập toạ độ" name="coordinates_origin">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="text-white btn btn-success waves-effect waves-light mb-2 mr-2">Thêm</button>
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
                                        @if (session()->has('failures'))
                                            <table class="table table-danger">
                                                <tr>
                                                    <th colspan="2" class="text-center font-weight-bold">Có một số lỗi xảy ra</th>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Hàng</td>
                                                    <td class="font-weight-bold">Lỗi</td>
                                                </tr>
                                                @foreach(session()->get('failures') as $validation)
                                                    <tr>
                                                        <td>{{ $validation->row() }}</td>
                                                        <td>
                                                            <ul>
                                                                @foreach($validation->errors() as $e)
                                                                    <li>{{ $e }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @endif
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-centered table-nowrap">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th rowspan="2" class="text-center">STT</th>
                                                        <th colspan="4" class="text-center">Toạ độ TH-TSL tại trạm</th>
                                                        <th rowspan="2">Nhãn luồng</th>
                                                        <th rowspan="2">Dịch vụ</th>
                                                        <th rowspan="2">Loại tín hiệu</th>
                                                        <th colspan="3" class="text-center">Truyền dẫn tại trạm</th>
                                                        <th colspan="4" class="text-center">Toạ độ TH-TSL đầu xa</th>
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
                                                    @foreach ($tv_streams as $item)
                                                        <tr>
                                                            <td class="text-center">{{ $stt++ }}</td>
                                                            <td>
                                                                {{ $item->Device->name }}
                                                            </td>
                                                            <td>{{ $item->name_card }}</td>
                                                            <td>{{ $item->coordinates_origin }}</td>
                                                            <td>{{ $item->port_origin }}</td>
                                                            <td>{{ $item->thread_label }}</td>
                                                            <td>{{ $item->service }}</td>
                                                            <td>{{ $item->signal_type }}</td>
                                                            <td>{{ $item->device_station }}</td>
                                                            <td>{{ $item->coordinates_station }}</td>
                                                            <td>{{ $item->port_station }}</td>
                                                            <td>{{ $item->station }}</td>
                                                            <td>{{ $item->device }}</td>
                                                            <td>{{ $item->coordinates_remote }}</td>
                                                            <td>{{ $item->port_remote }}</td>
                                                            <td>{{ $item->note }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($item->updated_at)) }}</td>
                                                            <td class="text-center">
                                                                <ul class="list-inline font-size-20 contact-links mb-0">
                                                                    @can('Chỉnh sửa luồng TH-TSL')
                                                                    <li class="list-inline-item px">
                                                                        <button type="button" class="border-0 bg-white" data-toggle="modal" data-target="#modal-edit{{ $item->id }}"><i class="mdi mdi-pencil text-success"></i></button>
                                                                    </li>
                                                                    @endcan
                                                                    @can('Xóa luồng TH-TSL')
                                                                    <li class="list-inline-item px">
                                                                        <form method="post" action="{{ route('tv_streams.destroy', $item->id) }}">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            
                                                                            <button type="submit" data-toggle="tooltip" data-placement="top" title="Xóa" class="border-0 bg-white"><i class="mdi mdi-trash-can text-danger"></i></button>
                                                                        </form>
                                                                    </li>
                                                                    @endcan
                                                                </ul>

<div class="modal fade" id="modal-edit{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Sửa Card</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" action="{{ route('tv_streams.update', $item->id) }}" enctype="multipart/form-data">
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
                                        {{ $item->Device->name }}
                                    </td>
                                    <td><input style="width: 135px;" required type="text" class="form-control" placeholder="Nhập tên card" name="name_card" value="{{ $item->name_card }}"></td>
                                    <td><input style="width: 135px;" required type="text" class="form-control" placeholder="Nhập toạ độ" name="coordinates_origin" value="{{ $item->coordinates_origin }}"></td>
                                    <td><input style="width: 135px;" required type="text" class="form-control" placeholder="Nhập port" name="port_origin" value="{{ $item->port_origin }}"></td>
                                    <td><input style="width: 135px;" type="text" class="form-control" placeholder="Nhập nhãn luồng" name="thread_label" value="{{ $item->thread_label }}"></td>
                                    <td><input style="width: 135px;" type="text" class="form-control" placeholder="Nhập dịch vụ" name="service" value="{{ $item->service }}"></td>
                                    <td><input style="width: 135px;" type="text" class="form-control" placeholder="Nhập loại tín hiệu" name="signal_type" value="{{ $item->signal_type }}"></td>
                                    <td><input style="width: 135px;" type="text" class="form-control" placeholder="Nhập thiết bị" name="device_station" value="{{ $item->device_station }}"></td>
                                    <td><input style="width: 135px;" type="text" class="form-control" placeholder="Nhập toạ độ" name="coordinates_station" value="{{ $item->coordinates_station }}"></td>
                                    <td><input style="width: 135px;" type="number" min="1" class="form-control" placeholder="Nhập port" name="port_station" value="{{ $item->port_station }}"></td>
                                    <td><input style="width: 135px;" type="text" class="form-control" placeholder="Nhập port" name="station" value="{{ $item->station }}"></td>
                                    <td><input style="width: 135px;" type="text" class="form-control" placeholder="Nhập port" name="device" value="{{ $item->device }}"></td>
                                    <td><input style="width: 135px;" type="text" class="form-control" placeholder="Nhập port" name="coordinates_remote" value="{{ $item->coordinates_remote }}"></td>
                                    <td><input style="width: 135px;" type="number" min="1" class="form-control" placeholder="Nhập port" name="port_remote" value="{{ $item->port_remote }}"></td>
                                    <td><input style="width: 135px;" type="text" class="form-control" placeholder="Nhập port" name="note" value="{{ $item->note }}"></td>
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

                                        <div class="row">
                                            <div class="col-lg-3">
                                                <a href="{{ route('tv_streams.print', $request->all()) }}" class="d-inline-block text-white btn btn-success btn-rounded waves-effect waves-light mt-2 mb-2"><i class="bx bx-printer mr-1"></i> In file quản lý</a>
                                            </div>

                                            @can('Nhập excel luồng TH-TSL')
                                            @if (isset($request->device_id))
                                                <div class="col-lg-9 text-right">
                                                    <form action="{{ route('tv_streams.import-excel') }}" method="POST" enctype="multipart/form-data" class="mt-2">
                                                        @csrf

                                                        <input type="text" name="device_id" hidden value="{{ $request->device_id }}">
                                                        <input type="file" name="file" required>
                                                        <button type="submit" class="btn btn-success">Nhập excel</button>
                                                    </form>
                                                </div>
                                            @endif
                                            @endcan
                                        </div>
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
                    url: "{{ url('/') }}/station/get-unit-child-list",
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
                                    <span> <i class="fa fa-plus-circle extend-level" aria-hidden="true" data-id="${value.id}" onclick="extendDevice(${value.id})" id="i-${value.id}"></i> ` + value.name + ` </span>
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
                    url: "{{ url('/') }}/device/get-device-television-by-station",
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
                                    <a href="{{ url('/') }}/tv_streams?device_id=${value.id}"> ${value.name}</a>
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
            padding-left: 0px;
        }
        .parent {
            display: block;
             border: 1px solid #4c4848; 
            padding-left: 10px;
            color: #4c4848;
            text-decoration: none;
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
            left: 0px;
            border-left: 1px solid #4c4848;
            border-bottom: 1px solid #4c4848;
            width: 7px;
            height: 15px;
        }
        .wtree li:after {
            position: absolute;
            content: "";
            top: 5px;
            left: 0px;
            border-left: 1px solid #4c4848;
            border-top: 1px solid #4c4848;
            width: 7px;
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
        .col-lg-2 {
            flex: 0 0 13.66667%!important;
            max-width: 13.66667%!important;
        }
        .col-lg-10 {
            flex: 0 0 86.33333%!important;
            max-width: 86.33333%!important;
        }
    </style>
@endpush