<div class="card">
    <div class="card-body">

        <h4 class="card-title">Thông tin cơ bản</h4>
        <p class="card-title-desc">Điền tất cả thông tin bên dưới</p>
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name">Tên thuốc <span class="text-danger">*</span></label>
                    <input id="name" name="name" type="text" class="form-control" placeholder="Tên thuốc" value="{{ old('name', $data_edit->name ?? '') }}">
                    {!! $errors->first('name', '<span class="error">:message</span>') !!}
                </div>
                    
                <div class="form-group">
                    <label for="price">Giá <span class="text-danger">*</span></label>
                    <input id="price" name="price" type="number" class="form-control" placeholder="Giá" value="{{ old('price', $data_edit->price ?? '') }}">
                    {!! $errors->first('price', '<span class="error">:message</span>') !!}
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="type_id">Loại thuốc <span class="text-danger">*</span></label>
                    <select class="form-control select2" name="type_id">
                        <option value="">Chọn loại thuốc</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" {{ isset($data_edit->type_id) && $data_edit->type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('type_id', '<span class="error">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="unit">Đơn vị tính <span class="text-danger">*</span></label>
                    <input id="unit" name="unit" type="text" class="form-control" placeholder="Đơn vị tính" value="{{ old('unit', $data_edit->unit ?? '') }}">
                    {!! $errors->first('unit', '<span class="error">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-3">Mô tả</h4>

        <textarea id="description" class="summernote mb-2" name="description">{{ isset($data_edit->description) ? $data_edit->description : '' }}</textarea>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
            <a href="{{ route('medicines.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
        </div>
    </div>

</div>