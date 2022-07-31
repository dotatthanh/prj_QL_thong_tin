<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tạo vai trò
        $admin = Role::create(['name' => 'Admin']);

        // Gán vai trò
        User::find(1)->assignRole('Admin');

        $view_user = Permission::create(['name' => 'Xem danh sách tài khoản']);
        $create_user = Permission::create(['name' => 'Thêm tài khoản']);
        $edit_user = Permission::create(['name' => 'Chỉnh sửa tài khoản']);
        $delete_user = Permission::create(['name' => 'Xóa tài khoản']);

        $admin->givePermissionTo($view_user);
        $admin->givePermissionTo($create_user);
        $admin->givePermissionTo($edit_user);
        $admin->givePermissionTo($delete_user);

        $view_role = Permission::create(['name' => 'Xem danh sách vai trò']);
        $create_role = Permission::create(['name' => 'Thêm vai trò']);
        $edit_role = Permission::create(['name' => 'Chỉnh sửa vai trò']);
        $delete_role = Permission::create(['name' => 'Xóa vai trò']);

        $admin->givePermissionTo($view_role);
        $admin->givePermissionTo($create_role);
        $admin->givePermissionTo($edit_role);
        $admin->givePermissionTo($delete_role);

        $view_permission = Permission::create(['name' => 'Xem danh sách quyền']);
        $view_permission_detail = Permission::create(['name' => 'Xem quyền']);
        $edit_permission = Permission::create(['name' => 'Chỉnh sửa quyền']);

        $admin->givePermissionTo($view_permission);
        $admin->givePermissionTo($view_permission_detail);
        $admin->givePermissionTo($edit_permission);

        // Mới
        $view_unit = Permission::create(['name' => 'Xem danh sách đơn vị BĐKT']);
        $create_unit = Permission::create(['name' => 'Thêm đơn vị BĐKT']);
        $edit_unit = Permission::create(['name' => 'Chỉnh sửa đơn vị BĐKT']);
        $delete_unit = Permission::create(['name' => 'Xóa đơn vị BĐKT']);

        $admin->givePermissionTo($view_unit);
        $admin->givePermissionTo($create_unit);
        $admin->givePermissionTo($edit_unit);
        $admin->givePermissionTo($delete_unit);

        $view_station = Permission::create(['name' => 'Xem danh sách trạm']);
        $create_station = Permission::create(['name' => 'Thêm trạm']);
        $edit_station = Permission::create(['name' => 'Chỉnh sửa trạm']);
        $delete_station = Permission::create(['name' => 'Xóa trạm']);

        $admin->givePermissionTo($view_station);
        $admin->givePermissionTo($create_station);
        $admin->givePermissionTo($edit_station);
        $admin->givePermissionTo($delete_station);

        // $view_device = Permission::create(['name' => 'Xem danh sách thiết bị']);
        $create_device = Permission::create(['name' => 'Thêm thiết bị']);
        $edit_device = Permission::create(['name' => 'Chỉnh sửa thiết bị']);
        $delete_device = Permission::create(['name' => 'Xóa thiết bị']);

        // $admin->givePermissionTo($view_device);
        $admin->givePermissionTo($create_device);
        $admin->givePermissionTo($edit_device);
        $admin->givePermissionTo($delete_device);

        $view_software = Permission::create(['name' => 'Xem danh sách phần mềm hỗ trợ']);
        $create_software = Permission::create(['name' => 'Thêm phần mềm hỗ trợ']);
        $edit_software = Permission::create(['name' => 'Chỉnh sửa phần mềm hỗ trợ']);
        $delete_software = Permission::create(['name' => 'Xóa phần mềm hỗ trợ']);

        $admin->givePermissionTo($view_software);
        $admin->givePermissionTo($create_software);
        $admin->givePermissionTo($edit_software);
        $admin->givePermissionTo($delete_software);

        $view_document = Permission::create(['name' => 'Xem danh sách tài liệu']);
        $create_document = Permission::create(['name' => 'Thêm tài liệu']);
        $edit_document = Permission::create(['name' => 'Chỉnh sửa tài liệu']);
        $delete_document = Permission::create(['name' => 'Xóa tài liệu']);

        $admin->givePermissionTo($view_document);
        $admin->givePermissionTo($create_document);
        $admin->givePermissionTo($edit_document);
        $admin->givePermissionTo($delete_document);

        $view_transmission_stream = Permission::create(['name' => 'Xem danh sách luồng truyền dẫn']);
        $create_transmission_stream = Permission::create(['name' => 'Thêm luồng truyền dẫn']);
        $edit_transmission_stream = Permission::create(['name' => 'Chỉnh sửa luồng truyền dẫn']);
        // $delete_transmission_stream = Permission::create(['name' => 'Xóa luồng truyền dẫn']);

        $admin->givePermissionTo($view_transmission_stream);
        $admin->givePermissionTo($create_transmission_stream);
        $admin->givePermissionTo($edit_transmission_stream);
        // $admin->givePermissionTo($delete_transmission_stream);

        $view_tv_stream = Permission::create(['name' => 'Xem danh sách luồng TH-TSL']);
        $create_tv_stream = Permission::create(['name' => 'Thêm luồng TH-TSL']);
        $edit_tv_stream = Permission::create(['name' => 'Chỉnh sửa luồng TH-TSL']);
        // $delete_tv_stream = Permission::create(['name' => 'Xóa luồng TH-TSL']);

        $admin->givePermissionTo($view_tv_stream);
        $admin->givePermissionTo($create_tv_stream);
        $admin->givePermissionTo($edit_tv_stream);
        // $admin->givePermissionTo($delete_tv_stream);
    }
}
