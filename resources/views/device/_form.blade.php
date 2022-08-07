@csrf
<input name="type" type="text" value="{{ $type }}" hidden="">
<input name="id" type="text" value="{{ $id }}" hidden="">
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="name">Tên thiết bị <span class="text-danger">*</span></label>
            <input id="name" name="name" type="text" class="form-control" placeholder="Tên thiết bị" value="{{ old('name', $data_edit->name ?? '') }}">
            {!! $errors->first('name', '<span class="error">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="station_id">Trạm <span class="text-danger">*</span></label>
            <select class="form-control select2" name="station_id">
                <option value="">Chọn trạm</option>
                @foreach ($stations as $station)
                    <option value="{{ $station->id }}" {{ isset($data_edit->station_id) && $data_edit->station_id == $station->id ? 'selected' : '' }}>{{ $station->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('station_id', '<span class="error">:message</span>') !!}
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('device.transmission', $id) }}" class="btn btn-secondary waves-effect">Quay lại</a>