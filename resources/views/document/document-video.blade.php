@extends('layouts.default')

@section('title') Quản lý tài liệu @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Danh sách tài liệu</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Quản lý" data-toggle="tooltip" data-placement="top">Quản lý</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Tài liệu" data-toggle="tooltip" data-placement="top">Tài liệu</a></li>
                                    <li class="breadcrumb-item active">Tài liệu video</li>
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
                                <form method="GET" action="{{ route('document.video') }}">
                                    <div class="row mb-2">
                                        <div class="col-sm-5">
                                            <div class="search-box mr-2 mb-2 d-inline-block">
                                                <div class="position-relative">
                                                    <input type="text" name="search" class="form-control" placeholder="Nhập tên tài liệu">
                                                    <i class="bx bx-search-alt search-icon"></i>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                                <i class="bx bx-search-alt search-icon font-size-16 align-middle mr-2"></i> Tìm kiếm
                                            </button>
                                        </div>
                                        
                                        {{-- @can('Thêm tài liệu') --}}
                                        <div class="col-sm-7">
                                            <div class="text-sm-right">
                                                <a href="{{ route('documents.create', [
                                                    'route' => 'document.video',
                                                    'type' => 1
                                                ]) }}" class="text-white btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"></i> Thêm tài liệu</a>
                                            </div>
                                        </div><!-- end col-->
                                        {{-- @endcan --}}
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap">
                                        <thead class="thead-light">
                                            <tr>
                                                <th style="width: 70px;" class="text-center">STT</th>
                                                <th>Video</th>
                                                <th>Tên tài liệu</th>
                                                <th>Tải xuống</th>
                                                <th class="text-center">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php ($stt = 1)
                                            @foreach ($documents as $document)
                                                <tr>
                                                    <td class="text-center">{{ $stt++ }}</td>
                                                    <td>
                                                        <button type="button" class="bx bx-play-circle border-0 bg-white btn-play display-4" data-toggle="modal" data-target="#modal-edit{{ $document->id }}"></button>
                                                    </td>
                                                    <td>
                                                        {{ $document->name }}
                                                    </td>
                                                    <td class="font-size-20">
                                                        <a href="{{ asset($document->file) }}" download data-toggle="tooltip" data-placement="top" title="Tải xuống"><i class="mdi mdi-cloud-download"></i></a>
                                                    </td>
                                                    <td class="text-center">
                                                        <ul class="list-inline font-size-20 contact-links mb-0">
                                                            {{-- @can('Chỉnh sửa tài liệu') --}}
                                                            <li class="list-inline-item px">
                                                                <a href="{{ route('documents.edit', $document->id) }}?route=document.video" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="mdi mdi-pencil text-success"></i></a>
                                                            </li>
                                                            {{-- @endcan --}}

                                                            {{-- @can('Xóa tài liệu') --}}
                                                            <li class="list-inline-item px">
                                                                <form method="post" action="{{ route('documents.destroy', $document->id) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    
                                                                    <button type="submit" data-toggle="tooltip" data-placement="top" title="Xóa" class="border-0 bg-white"><i class="mdi mdi-trash-can text-danger"></i></button>
                                                                </form>
                                                            </li>
                                                            {{-- @endcan --}}
                                                        </ul>
                                                    </td>
                                                </tr>

<div class="modal fade" id="modal-edit{{ $document->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

                <div class="modal-body m-auto">
                    <video width="320" height="240" controls>
                      <source src="{{ asset($document->file) }}" type="video/mp4">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
        </div>
    </div>
</div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{ $documents->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


       
    </div>
@endsection