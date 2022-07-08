@csrf
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="name">Tên phần mềm <span class="text-danger">*</span></label>
            <input id="name" name="name" type="text" class="form-control" placeholder="Tên phần mềm" value="{{ old('name', $data_edit->name ?? '') }}">
            {!! $errors->first('name', '<span class="error">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="image">Ảnh @if($routeType == 'create') <span class="text-danger">*</span> @endif</label>
            <input id="image" name="image" type="file" class="form-control" placeholder="Tên phần mềm" value="{{ old('image', $data_edit->image ?? '') }}">
            {!! $errors->first('image', '<span class="error">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="file">Tập tin cài đặt @if($routeType == 'create') <span class="text-danger">*</span> @endif</label>
            <input id="file" name="file" type="file" class="form-control" placeholder="Tập tin cài đặt" value="{{ old('file', $data_edit->file ?? '') }}">
            {!! $errors->first('file', '<span class="error">:message</span>') !!}
        </div>
    </div>

</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('softwares.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>