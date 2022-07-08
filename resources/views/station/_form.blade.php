@csrf
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="name">Tên trạm <span class="text-danger">*</span></label>
            <input id="name" name="name" type="text" class="form-control" placeholder="Tên trạm" value="{{ old('name', $data_edit->name ?? '') }}">
            {!! $errors->first('name', '<span class="error">:message</span>') !!}
        </div>

        <div class="form-group">
            <label for="phone_number">Số điện thoại <span class="text-danger">*</span></label>
            <input id="phone_number" name="phone_number" type="number" class="form-control" placeholder="Số điện thoại" value="{{ old('phone_number', $data_edit->phone_number ?? '') }}">
            {!! $errors->first('phone_number', '<span class="error">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="unit_id">Đơn vị BĐKT <span class="text-danger">*</span></label>
            <select class="form-control select2" name="unit_id">
                <option value="">Chọn đơn vị BĐKT</option>
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}" {{ isset($data_edit->unit_id) && $data_edit->unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('unit_id', '<span class="error">:message</span>') !!}
        </div>

        <div class="form-group">
            <label for="address">Địa chỉ <span class="text-danger">*</span></label>
            <input id="address" name="address" type="text" class="form-control" placeholder="Địa chỉ" value="{{ old('address', $data_edit->address ?? '') }}">
            {!! $errors->first('address', '<span class="error">:message</span>') !!}
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('stations.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>