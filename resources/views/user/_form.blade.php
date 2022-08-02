@csrf
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="name">Họ và tên <span class="text-danger">*</span></label>
            <input id="name" name="name" type="text" class="form-control" placeholder="Họ và tên" value="{{ old('name', $data_edit->name ?? '') }}">
            {!! $errors->first('name', '<span class="error">:message</span>') !!}
        </div>

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

        @if ($routeType == 'create')
            <div class="form-group">
                <label for="userpassword">Mật khẩu <span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="userpassword" placeholder="Nhập mật khẩu" autocomplete="new-password" name="password">
                {!! $errors->first('password', '<span class="error">:message</span>') !!}
            </div>
        @endif

    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="username">Tên đăng nhập <span class="text-danger">*</span></label>
            <input id="username" name="username" type="text" class="form-control" placeholder="Nhập tên đăng nhập" value="{{ old('username', $data_edit->username ?? '') }}">
            {!! $errors->first('username', '<span class="error">:message</span>') !!}
        </div>

        <div class="form-group">
            <label for="role">Vai trò <span class="text-danger">*</span></label>
            <select 
                name="roles[]" 
                id="addRole" 
                class="select2 select2-multiple form-control"
                multiple
                data-placeholder="Chọn vai trò ..."
            >
                @foreach ($roles as $item)
                    <option 
                        {{ isset($data_edit) && in_array($item->id, $data_edit->roles->pluck('id')->toArray()) ?
                        'selected' : '' }} 
                        value="{{ $item->id }}">
                        {{ $item->name }}
                    </option>
                @endforeach        
            </select>
            {!! $errors->first('roles', '<span class="error">:message</span>') !!}
        </div>

        @if ($routeType == 'create')
            <div class="form-group">
                <label for="password_confirmation">Xác nhận mật khẩu <span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="password_confirmation" placeholder="Nhập xác nhận mật khẩu" name="password_confirmation">        
            </div>
        @endif
    </div>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('users.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>