@extends('layouts.default')

@section('title') Cây hệ thống @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <img src="{{ asset('images/logo.png') }}" alt="" class="w-100 mb-5">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Cây hệ thống</h4>

                            {{-- <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('stations.index') }}" title="Quản lý trạm" data-toggle="tooltip" data-placement="top">Quản lý trạm</a></li>
                                    <li class="breadcrumb-item active">Cây hệ thống</li>
                                </ol>
                            </div> --}}
                        </div>

                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                @if (!empty($dataList))
                                    <p class="parent">{{ !empty($dataList['name']) ? $dataList['name']: '' }}</p>
                                    <ul class="wtree">
                                        @foreach ($dataList['childs'] as $lv2)
                                            <li>
                                                <span>{{ !empty($lv2['name']) ? $lv2['name']: '' }}</span>

                                                {{-- @if (count($lv2['childs']) > 0) --}}
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
                                                            <li id="li-{{ $lv3_station['id'] }}" class="close-el">
                                                                <span>
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
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


       
    </div>
@endsection

@push('js')
    <!-- select 2 plugin -->
    <script src="{{ asset('libs\select2\js\select2.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('js\pages\ecommerce-select2.init.js') }}"></script>

    <!-- datepicker -->
    <script src="{{ asset('libs\bootstrap-datepicker\js\bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('libs\bootstrap-colorpicker\js\bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('libs\bootstrap-timepicker\js\bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('libs\bootstrap-touchspin\jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('libs\bootstrap-maxlength\bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('libs\@chenfengyuan\datepicker\datepicker.min.js') }}"></script>
    <!-- form advanced init -->
    <script src="{{ asset('js\pages\form-advanced.init.js') }}"></script>
    <script type="text/javascript">
        $('.docs-date').datepicker({
            format: 'dd-mm-yyyy',
        });

        function extendLevel(parentId) {
            var li = $("#li-unit-" + parentId);
            console.log(li);
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
                                html += `<li id="li-`+ value.id +`" class="close-el">
                                    <span> Trạm: ` + value.name + ` </span>
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
    </script>
@endpush

@push('css')
    <link href="{{ asset('libs\select2\css\select2.min.css') }}" rel="stylesheet" type="text/css">
    <!-- datepicker css -->
    <link href="{{ asset('libs\bootstrap-datepicker\css\bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs\bootstrap-colorpicker\css\bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs\bootstrap-timepicker\css\bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('libs\@chenfengyuan\datepicker\datepicker.min.css') }}">

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
            width: 250px;
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
        .wtree li span {
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