@csrf
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="name">Tên đơn vị BĐKT <span class="text-danger">*</span></label>
            <input id="name" name="name" type="text" class="form-control" placeholder="Tên đơn vị BĐKT" value="{{ old('name', $data_edit->name ?? '') }}">
            {!! $errors->first('name', '<span class="error">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="parent_id">Đơn vị trực thuộc</label>
            <select class="form-control select2" name="parent_id">
                <option value="">Chọn đơn vị trực thuộc</option>
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}" {{ isset($data_edit->parent_id) && $data_edit->parent_id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('units.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>