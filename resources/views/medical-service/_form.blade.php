@csrf
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="name">Tên dịch vụ khám <span class="text-danger">*</span></label>
            <input id="name" name="name" type="text" class="form-control" placeholder="Tên dịch vụ khám" value="{{ old('name', $data_edit->name ?? '') }}">
            {!! $errors->first('name', '<span class="error">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="price">Giá <span class="text-danger">*</span></label>
            <input id="price" name="price" type="number" class="form-control" placeholder="Giá" value="{{ old('price', $data_edit->price ?? '') }}">
            {!! $errors->first('price', '<span class="error">:message</span>') !!}
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('medical_services.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>