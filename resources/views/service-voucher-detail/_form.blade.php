@csrf
<div class="card">
    <div class="card-body">

        <h4 class="card-title">Thông tin khám</h4>
        <div class="row">
            <div class="col-sm-2">
                <label>Mã phiếu dịch vụ :</label>
            </div>

            <div class="col-sm-10">
                <label>{{ $service_voucher->code }}</label>
            </div>

            <div class="col-sm-2">
                <label>Tên bệnh nhân :</label>
            </div>

            <div class="col-sm-4">
                <label class="font-weight-bold">{{ $service_voucher->patient->name }}</label>
            </div>

            <div class="col-sm-2">
                <label>Dịch vụ khám :</label>
            </div>

            <div class="col-sm-4">
                <label class="font-weight-bold">{{ $service_voucher->medicalService->name }}</label>
            </div>

            <div class="col-sm-2">
                <label>Thẻ BHYT :</label>
            </div>

            <div class="col-sm-4">
                <div class="custom-control custom-checkbox  custom-checkbox-danger mb-3">
                    @if ($service_voucher->is_health_insurance_card)
                    <input type="checkbox" class="custom-control-input" id="check_insurance_card" disabled checked>
                    <label class="custom-control-label" for="check_insurance_card">Miễn phí dịch vụ khám</label>
                    @else
                    <input type="checkbox" class="custom-control-input" id="check_insurance_card" disabled>
                    <label class="custom-control-label" for="check_insurance_card">Miễn phí dịch vụ khám</label>
                    @endif
                </div>
            </div>

            <div class="col-sm-2">
                <label>Tên bác sĩ :</label>
            </div>

            <div class="col-sm-4">
                <label class="font-weight-bold">{{ $service_voucher->user->name }}</label>
            </div>

            <div class="col-sm-2">
                <label>Từ ngày :</label>
            </div>

            <div class="col-sm-4">
                <label class="font-weight-bold">{{ date("d-m-Y", strtotime($service_voucher->start_date)) }}</label>
            </div>

            <div class="col-sm-2">
                <label>Đến ngày :</label>
            </div>

            <div class="col-sm-4">
                <label class="font-weight-bold">{{ date("d-m-Y", strtotime($service_voucher->end_date)) }}</label>
            </div>

            <div class="col-sm-2">
                <label>Trạng thái :</label>
            </div>

            <div class="col-sm-4">
                @if ($service_voucher->status)
                <label class="text-success">Đã khám</label>
                @else
                <label class="text-warning">Chưa khám</label>
                @endif
            </div>

            <div class="col-sm-2">
                <label>Giá :</label>
            </div>

            <div class="col-sm-4">
                <label class="text-danger font-weight-bold">{{ number_format($service_voucher->total_money, 0, ',', '.') }} VNĐ</label>
            </div>

        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-3">Kết quả khám</h4>

        <input type="number" name="service_voucher_id" hidden value="{{ $service_voucher->id }}">

        <div class="form-group">
            <label for="date">Ngày khám <span class="text-danger">*</span></label>
            <div class="docs-datepicker">
                <div class="input-group">
                    <input type="text" class="form-control docs-date" name="date" placeholder="Chọn ngày" autocomplete="off" value="{{ old('date', isset($data_edit->date) ? date('d-m-Y', strtotime($data_edit->date)) : '') }}">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary docs-datepicker-trigger" disabled="">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="docs-datepicker-container"></div>
            </div>
            {!! $errors->first('date', '<span class="error">:message</span>') !!}
        </div>

        <div class="form-group">
            <label for="result">Kết quả <span class="text-danger">*</span></label>
            <textarea id="result" class="summernote mb-2" name="result">
                {{ old('result', isset($data_edit->result) ? ($data_edit->result) : '') }}
            </textarea>
            {!! $errors->first('result', '<span class="error mt-1 d-block">:message</span>') !!}
        </div>
    </div>

</div>

<div class="card">
    <div class="card-body">
        <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
        <a href="{{ route('service_vouchers.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
    </div>
</div>