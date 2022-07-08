<div class="card">
    <div class="card-body">
        <h4 class="card-title">Thông tin cơ bản</h4>
        <p class="card-title-desc">Điền tất cả thông tin bên dưới</p>
        @csrf
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="title">Tiêu đề <span class="text-danger">*</span></label>
                    <input id="title" name="title" type="text" class="form-control" placeholder="Tiêu đề" value="{{ old('title', $data_edit->title ?? '') }}">
                    {!! $errors->first('title', '<span class="error">:message</span>') !!}
                </div>
            </div>

            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="patient_id">Tên bệnh nhân <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="patient_id" onchange="getInsuranceCard($(this).val())">
                                <option value="">Chọn bệnh nhân</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ isset($data_edit->patient_id) && $data_edit->patient_id == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('patient_id', '<span class="error">:message</span>') !!}
                        </div>

                    </div>

                    <div class="col-sm-6">
                        <label for="patient_id" class="mt-2">Thẻ BHYT</label>
                        <div class="custom-control custom-checkbox  custom-checkbox-danger mb-3">
                            <input type="checkbox" class="custom-control-input" id="check_insurance_card" disabled {{ isset($data_edit->patient->healthInsuranceCard) && $data_edit->patient->healthInsuranceCard ? 'checked' : '' }}>
                            <input type="checkbox" hidden id="is_health_insurance_card" name="is_health_insurance_card" {{ isset($data_edit->patient->healthInsuranceCard) && $data_edit->patient->healthInsuranceCard ? 'checked' : '' }}>
                            <label class="custom-control-label" for="check_insurance_card">Miễn phí dịch vụ khám</label>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="total_money">Giá <span class="text-danger">*</span></label>
                            <input id="total_money" name="total_money" type="number" class="form-control" placeholder="Giá" value="{{ old('total_money', $data_edit->total_money ?? '') }}">
                            {!! $errors->first('total_money', '<span class="error">:message</span>') !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="consulting_room_id">Phòng khám <span class="text-danger">*</span></label>
                    <select class="form-control select2" name="consulting_room_id">
                        <option value="">Chọn phòng khám</option>
                        @foreach ($consulting_rooms as $consulting_room)
                            <option value="{{ $consulting_room->id }}" {{ isset($data_edit->consulting_room_id) && $data_edit->consulting_room_id == $consulting_room->id ? 'selected' : '' }}>{{ $consulting_room->name }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('consulting_room_id', '<span class="error">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="user_id">Bác sĩ <span class="text-danger">*</span></label>
                    <select class="form-control select2" name="user_id">
                        <option value="">Chọn bác sĩ</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ isset($data_edit->user_id) && $data_edit->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('user_id', '<span class="error">:message</span>') !!}
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
        <a href="{{ route('health_certifications.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
    </div>
</div>