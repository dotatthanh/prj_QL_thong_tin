@extends('layouts.default')

@section('title') Cập nhật đơn thuốc @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Cập nhật đơn thuốc</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('prescriptions.index') }}" title="Quản lý đơn thuốc" data-toggle="tooltip" data-placement="top">Quản lý đơn thuốc</a></li>
                                    <li class="breadcrumb-item active">Cập nhật đơn thuốc</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <form class="repeater custom-validation" method="POST" action="{{ route('prescriptions.update', $data_edit->id) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @include('prescription._form')
                        </form>

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

    <!-- form repeater js -->
    <script src="{{ asset('libs\jquery.repeater\jquery.repeater.min.js') }}"></script>

    <script src="{{ asset('js\pages\form-repeater.int.js') }}"></script>

    <script src="{{ asset('libs\parsleyjs\parsley.min.js') }}"></script>

    <script src="{{ asset('js\pages\form-validation.init.js') }}"></script>

    <script type="text/javascript">
        $('.docs-date').datepicker({
            format: 'dd-mm-yyyy',
        });

        function getInsuranceCard(id) {
            if (id){
                $.ajax({
                    url: "/health_insurance_cards/"+id+"/get-insurance-card",
                    type: "POST",
                    success: function (respon) {
                        if (respon) {
                            $(`#check_insurance_card`).prop('checked', true);
                            $(`#is_health_insurance_card`).prop('checked', true);
                            $(`#total_money`).val(0).prop('readonly', true);
                        }
                        else {
                            $(`#check_insurance_card`).prop('checked', false);
                            $(`#is_health_insurance_card`).prop('checked', false);
                            $(`#total_money`).prop('readonly', false);
                        }
                    },
                    errors: function () {
                        alert('Lỗi server!!!');
                    }
                });
            }
            else {
                $(`#check_insurance_card`).prop('checked', false);
                $(`#is_health_insurance_card`).prop('checked', false);
                $(`#total_money`).prop('readonly', false);
            }
        }
    </script>
@endpush

@push('css')
    <!-- datepicker css -->
    <link href="{{ asset('libs\bootstrap-datepicker\css\bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs\bootstrap-colorpicker\css\bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs\bootstrap-timepicker\css\bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('libs\@chenfengyuan\datepicker\datepicker.min.css') }}">
    <!-- select2 css -->
    <link href="{{ asset('libs\select2\css\select2.min.css') }}" rel="stylesheet" type="text/css">

    <style type="text/css">
        .custom-validate-select .filled{
            position: absolute;
            top: 65px;
        }
    </style>
@endpush