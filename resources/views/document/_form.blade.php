@csrf
<div class="row">
    <input id="route" name="route" type="text" value="{{ $route }}" hidden="">
    <input id="type" name="type" type="text" value="{{ $type }}" hidden="">

    <div class="col-sm-6">
        <div class="form-group">
            <label for="name">Tên tài liệu <span class="text-danger">*</span></label>
            <input id="name" name="name" type="text" class="form-control" placeholder="Tên tài liệu" value="{{ old('name', $data_edit->name ?? '') }}">
            {!! $errors->first('name', '<span class="error">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="file">Tập tin tài liệu @if($routeType == 'create') <span class="text-danger">*</span> @endif</label>
            <input id="file" name="file" type="file" class="form-control" placeholder="Tập tin tài liệu" value="{{ old('file', $data_edit->file ?? '') }}">
            {!! $errors->first('file', '<span class="error">:message</span>') !!}
        </div>
    </div>

    @if ($route != "document.video")
    <div class="col-sm-6">
        <div class="form-group">
            <label for="image">Ảnh @if($routeType == 'create') <span class="text-danger">*</span> @endif</label>
            <input id="image" name="image" type="file" class="form-control" placeholder="Tên tài liệu" value="{{ old('image', $data_edit->image ?? '') }}">
            {!! $errors->first('image', '<span class="error">:message</span>') !!}
        </div>
    </div>
    @endif

</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('softwares.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>