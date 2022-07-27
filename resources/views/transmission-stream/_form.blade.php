@csrf

<div class="table-responsive">
    <table class="table table-bordered table-centered table-nowrap">
        <thead class="thead-light">
            <tr>
                <th rowspan="2" class="text-center">STT</th>
                <th colspan="4" class="text-center">Toạ độ truyền dẫn tại trạm</th>
                <th rowspan="2" class="text-center">Nhãn luồng</th>
                <th rowspan="2" class="text-center">Dịch vụ</th>
                <th rowspan="2" class="text-center">Loại tín hiệu</th>
                <th colspan="4" class="text-center">Toạ độ truyền dẫn đầu xa</th>
                <th rowspan="2" class="text-center">Ghi chú</th>
            </tr>
            <tr>
                <th class="text-center">Thiết bị</th>
                <th class="text-center">Tên card</th>
                <th class="text-center">Toạ độ</th>
                <th class="text-center">Port</th>
                <th class="text-center">Trạm</th>
                <th class="text-center">Thiết bị</th>
                <th class="text-center">Toạ độ</th>
                <th class="text-center">Port</th>
            </tr>
        </thead>
        <tbody>
        	@php
        		$device = App\Models\Device::find($request->device_id);
        	@endphp
            @for ($port_origin = 1; $port_origin <= $request->port_origin; $port_origin++)
            	<input hidden type="text" name="device_id" value="{{ $request->device_id }}">
            	<input hidden type="text" name="name_card" value="{{ $request->name_card }}">
            	<input hidden type="text" name="port_origin" value="{{ $request->port_origin }}">
            	<input hidden type="text" name="signal_type" value="{{ $request->signal_type }}">
            	<input hidden type="text" name="coordinates_origin" value="{{ $request->coordinates_origin }}">

                <tr>
                    <td class="text-center">{{ $port_origin }}</td>
                    <td>{{ $device->name }}</td>
                    <td>{{ $request->name_card }}</td>
                    <td>{{ $request->coordinates_origin }}</td>
                    <td>{{ $port_origin }}</td>
                    <td>
                    	<input style="width: 135px;" type="text" class="form-control" placeholder="Nhập nhãn luồng" name="thread_label[]">
                    </td>
                    <td>
                    	<input style="width: 135px;" type="text" class="form-control" placeholder="Nhập dịch vụ" name="service[]">
                    </td>
                    <td>{{ $request->signal_type }}</td>
                    <td>
                    	<input style="width: 135px;" type="text" class="form-control" placeholder="Nhập trạm" name="station[]">
                    </td>
                    <td>
                    	<input style="width: 135px;" type="text" class="form-control" placeholder="Nhập thiết bị" name="device[]">
                    </td>
                    <td>
                    	<input style="width: 135px;" type="text" class="form-control" placeholder="Nhập toạ độ" name="coordinates_remote[]">
                    </td>
                    <td>
                    	<input style="width: 135px;" type="number" class="form-control" placeholder="Nhập port" name="port_remote[]">
                    </td>
                    <td>
                    	<input style="width: 135px;" type="text" class="form-control" placeholder="Nhập ghi chú" name="note[]">
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('transmission_streams.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>