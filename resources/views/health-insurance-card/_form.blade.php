@csrf
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="name">Họ và tên <span class="text-danger">*</span></label>
            <select class="form-control select2" name="patient_id">
                <option value="">Chọn bệnh nhân</option>
                @foreach ($patients as $patient)
                    <option value="{{ $patient->id }}" {{ isset($data_edit->patient_id) && $data_edit->patient_id == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('patient_id', '<span class="error">:message</span>') !!}
        </div>

        <div class="form-group">
            <label for="id_card">Mã số <span class="text-danger">*</span></label>
            <input id="id_card" name="id_card" type="text" class="form-control" placeholder="Mã số" value="{{ old('id_card', $data_edit->id_card ?? '') }}">
            {!! $errors->first('id_card', '<span class="error">:message</span>') !!}
        </div>

        <div class="form-group">
            <label for="hospital">Nơi đăng ký khám <span class="text-danger">*</span></label>
            <input id="hospital" name="hospital" type="text" class="form-control" placeholder="Nơi đăng ký khám" value="{{ old('hospital', $data_edit->hospital ?? '') }}">
            {!! $errors->first('hospital', '<span class="error">:message</span>') !!}
        </div>

    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="use_value">Giá trị sử dụng <span class="text-danger">*</span></label>
            <div class="docs-datepicker">
                <div class="input-group">
                    <input type="text" class="form-control docs-date" name="use_value" placeholder="Chọn ngày giá trị sử dụng" autocomplete="off" value="{{ old('use_value', isset($data_edit->use_value) ? date('d-m-Y', strtotime($data_edit->use_value)) : '') }}">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary docs-datepicker-trigger" disabled="">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="docs-datepicker-container"></div>
            </div>
            {!! $errors->first('use_value', '<span class="error">:message</span>') !!}
        </div>

        <div class="form-group">
            <label for="date_of_issue">Ngày cấp <span class="text-danger">*</span></label>
            <div class="docs-datepicker">
                <div class="input-group">
                    <input type="text" class="form-control docs-date" name="date_of_issue" placeholder="Chọn ngày cấp" autocomplete="off" value="{{ old('date_of_issue', isset($data_edit->date_of_issue) ? date('d-m-Y', strtotime($data_edit->date_of_issue)) : '') }}">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary docs-datepicker-trigger" disabled="">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="docs-datepicker-container"></div>
            </div>
            {!! $errors->first('date_of_issue', '<span class="error">:message</span>') !!}
        </div>

        <div class="form-group">
            <label for="issued_by">Nơi cấp <span class="text-danger">*</span></label>
            <input id="issued_by" name="issued_by" type="text" class="form-control" placeholder="Nơi cấp" value="{{ old('issued_by', $data_edit->issued_by ?? '') }}">
            {!! $errors->first('issued_by', '<span class="error">:message</span>') !!}
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('health_insurance_cards.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>