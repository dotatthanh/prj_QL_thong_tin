@extends('layouts.default')

@section('title') Xem video @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <img src="{{ asset('images/logo.png') }}" alt="" class="w-100 mb-5">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Xem video</h4>

                            {{-- <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('stations.index') }}" title="Quản lý tài liệu" data-toggle="tooltip" data-placement="top">Quản lý tài liệu</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('stations.index') }}" title="Tài liệu video" data-toggle="tooltip" data-placement="top">Tài liệu video</a></li>
                                    <li class="breadcrumb-item active">Xem video</li>
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
                                <h4 class="card-title">Video: {{ $document->name }}</h4>

                                <div class="text-center mt-3">
                                    <video id="player" width="1000" controls>
                                        <source src="{{ asset($document->file) }}" type="video/mp4">
                                    </video>
                                </div>
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
    <script src="{{ asset('js\plyr.polyfilled.js') }}"></script>
    <script>
        const player = new Plyr('#player');
    </script>
@endpush

@push('css')
    <link href="{{ asset('css\plyr.css') }}" rel="stylesheet" type="text/css">
@endpush