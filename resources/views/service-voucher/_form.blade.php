<div class="card">
    <div class="card-body">

        <h4 class="card-title">Thông tin cơ bản</h4>
        <p class="card-title-desc">Điền tất cả thông tin bên dưới</p>
        @csrf
        <div class="row">
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
                            <label for="total_money">Dịch vụ khám <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="medical_service_id">
                                <option value="">Chọn dịch vụ khám</option>
                                @foreach ($medical_services as $medical_service)
                                    <option value="{{ $medical_service->id }}" {{ isset($data_edit->medical_service_id) && $data_edit->medical_service_id == $medical_service->id ? 'selected' : '' }}>{{ $medical_service->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('medical_service_id', '<span class="error">:message</span>') !!}
                        </div>

                        <div class="form-group">
                            <label for="start_date">Ngày bắt đầu <span class="text-danger">*</span></label>
                            <div class="docs-datepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control docs-date" name="start_date" placeholder="Chọn ngày" autocomplete="off" value="{{ old('start_date', isset($data_edit->start_date) ? date('d-m-Y', strtotime($data_edit->start_date)) : '') }}">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary docs-datepicker-trigger" disabled="">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="docs-datepicker-container"></div>
                            </div>
                            {!! $errors->first('start_date', '<span class="error">:message</span>') !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
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
                
                <div class="form-group">
                    <label for="end_date">Ngày kết thúc <span class="text-danger">*</span></label>
                    <div class="docs-datepicker">
                        <div class="input-group">
                            <input type="text" class="form-control docs-date" name="end_date" placeholder="Chọn ngày" autocomplete="off" value="{{ old('end_date', isset($data_edit->end_date) ? date('d-m-Y', strtotime($data_edit->end_date)) : '') }}">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary docs-datepicker-trigger" disabled="">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <div class="docs-datepicker-container"></div>
                    </div>
                    {!! $errors->first('end_date', '<span class="error">:message</span>') !!}
                </div>
            </div>

        </div>
    </div>
</div>

@if (isset($data_edit) && $data_edit->serviceVoucherDetails->count())
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Kết quả</h4>

            <div class="row">
                <div class="col-sm-12">
                    <label>Chi tiết khám :</label>
                </div>

                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" width="70px">STT</th>
                                    <th>Ngày khám</th>
                                    <th>Kết quả</th>
                                    <th width="100px">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($stt = 1)
                                @foreach ($data_edit->serviceVoucherDetails as $service_voucher_detail)
                                    <tr>
                                        <td class="text-center">{{ $stt++ }}</td>
                                        <td>{{ date("d-m-Y", strtotime($service_voucher_detail->date)) }}</td>
                                        <td>
                                            {!! $service_voucher_detail->result !!}
                                        </td>
                                        <td class="text-center">
                                            <ul class="list-inline font-size-20 contact-links mb-0">
                                                    <li class="list-inline-item px">
                                                        <a href="{{ route('service_voucher_details.edit', $service_voucher_detail->id) }}" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="mdi mdi-pencil text-success"></i></a>
                                                    </li>
                                                    
                                                    <li class="list-inline-item px">
                                                        <a href="{{ route('service_voucher_details.delete', $service_voucher_detail->id) }}" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="mdi mdi-trash-can text-danger"></i></a>
                                                    </li>

                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endif

<div class="card">
    <div class="card-body">
        <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
        <a href="{{ route('service_vouchers.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
    </div>
</div>