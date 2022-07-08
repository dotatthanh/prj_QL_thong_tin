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

        // Tạo quyền
        $view_health_certification = Permission::create(['name' => 'Xem danh sách giấy khám bệnh']);
        $view_detail_health_certification = Permission::create(['name' => 'Xem thông tin giấy khám bệnh']);
        $create_health_certification = Permission::create(['name' => 'Thêm giấy khám bệnh']);
        $edit_health_certification = Permission::create(['name' => 'Chỉnh sửa giấy khám bệnh']);
        $delete_health_certification = Permission::create(['name' => 'Xóa giấy khám bệnh']);
        $conclude_health_certification = Permission::create(['name' => 'Kết luận khám giấy khám bệnh']);
        $print_health_certification = Permission::create(['name' => 'In giấy khám bệnh']);
        $list_prescription = Permission::create(['name' => 'Kê đơn thuốc']);

        // Set quyền cho vai trò admin
        $admin->givePermissionTo($view_health_certification);
        $admin->givePermissionTo($view_detail_health_certification);
        $admin->givePermissionTo($create_health_certification);
        $admin->givePermissionTo($edit_health_certification);
        $admin->givePermissionTo($delete_health_certification);
        $admin->givePermissionTo($conclude_health_certification);
        $admin->givePermissionTo($print_health_certification);
        $admin->givePermissionTo($list_prescription);

        $view_prescription = Permission::create(['name' => 'Xem danh sách đơn thuốc']);
        $view_detail_prescription = Permission::create(['name' => 'Xem thông tin đơn thuốc']);
        $create_prescription = Permission::create(['name' => 'Thêm đơn thuốc']);
        $edit_prescription = Permission::create(['name' => 'Chỉnh sửa đơn thuốc']);
        $delete_prescription = Permission::create(['name' => 'Xóa đơn thuốc']);
        $confirm_payment_prescription = Permission::create(['name' => 'Xác nhận thanh toán đơn thuốc']);
        $print_prescription = Permission::create(['name' => 'In đơn thuốc']);

        $admin->givePermissionTo($view_prescription);
        $admin->givePermissionTo($view_detail_prescription);
        $admin->givePermissionTo($create_prescription);
        $admin->givePermissionTo($edit_prescription);
        $admin->givePermissionTo($delete_prescription);
        $admin->givePermissionTo($confirm_payment_prescription);
        $admin->givePermissionTo($print_prescription);

        $view_service_voucher = Permission::create(['name' => 'Xem danh sách phiếu dịch vụ']);
        $view_detail_service_voucher = Permission::create(['name' => 'Xem thông tin phiếu dịch vụ']);
        $create_service_voucher = Permission::create(['name' => 'Thêm phiếu dịch vụ']);
        $edit_service_voucher = Permission::create(['name' => 'Chỉnh sửa phiếu dịch vụ']);
        $delete_service_voucher = Permission::create(['name' => 'Xóa phiếu dịch vụ']);
        $complete_examination_service_voucher = Permission::create(['name' => 'Hoàn thành khám phiếu dịch vụ']);
        $conclude_service_voucher = Permission::create(['name' => 'Kết luận khám phiếu dịch vụ']);
        $print_service_voucher = Permission::create(['name' => 'In phiếu dịch vụ']);

        $admin->givePermissionTo($view_service_voucher);
        $admin->givePermissionTo($view_detail_service_voucher);
        $admin->givePermissionTo($create_service_voucher);
        $admin->givePermissionTo($edit_service_voucher);
        $admin->givePermissionTo($delete_service_voucher);
        $admin->givePermissionTo($complete_examination_service_voucher);
        $admin->givePermissionTo($conclude_service_voucher);
        $admin->givePermissionTo($print_service_voucher);

        $view_consulting_room = Permission::create(['name' => 'Xem danh sách phòng khám']);
        $create_consulting_room = Permission::create(['name' => 'Thêm phòng khám']);
        $edit_consulting_room = Permission::create(['name' => 'Chỉnh sửa phòng khám']);
        $delete_consulting_room = Permission::create(['name' => 'Xóa phòng khám']);

        $admin->givePermissionTo($view_consulting_room);
        $admin->givePermissionTo($create_consulting_room);
        $admin->givePermissionTo($edit_consulting_room);
        $admin->givePermissionTo($delete_consulting_room);

        $view_medical_service = Permission::create(['name' => 'Xem danh sách dịch vụ khám']);
        $create_medical_service = Permission::create(['name' => 'Thêm dịch vụ khám']);
        $edit_medical_service = Permission::create(['name' => 'Chỉnh sửa dịch vụ khám']);
        $delete_medical_service = Permission::create(['name' => 'Xóa dịch vụ khám']);

        $admin->givePermissionTo($view_medical_service);
        $admin->givePermissionTo($create_medical_service);
        $admin->givePermissionTo($edit_medical_service);
        $admin->givePermissionTo($delete_medical_service);

        $view_type = Permission::create(['name' => 'Xem danh sách loại thuốc']);
        $create_type = Permission::create(['name' => 'Thêm loại thuốc']);
        $edit_type = Permission::create(['name' => 'Chỉnh sửa loại thuốc']);
        $delete_type = Permission::create(['name' => 'Xóa loại thuốc']);

        $admin->givePermissionTo($view_type);
        $admin->givePermissionTo($create_type);
        $admin->givePermissionTo($edit_type);
        $admin->givePermissionTo($delete_type);

        $view_medicine = Permission::create(['name' => 'Xem danh sách thuốc']);
        $create_medicine = Permission::create(['name' => 'Thêm thuốc']);
        $edit_medicine = Permission::create(['name' => 'Chỉnh sửa thuốc']);
        $delete_medicine = Permission::create(['name' => 'Xóa thuốc']);

        $admin->givePermissionTo($view_medicine);
        $admin->givePermissionTo($create_medicine);
        $admin->givePermissionTo($edit_medicine);
        $admin->givePermissionTo($delete_medicine);

        $view_patient = Permission::create(['name' => 'Xem danh sách bệnh nhân']);
        $create_patient = Permission::create(['name' => 'Thêm bệnh nhân']);
        $edit_patient = Permission::create(['name' => 'Chỉnh sửa bệnh nhân']);
        $delete_patient = Permission::create(['name' => 'Xóa bệnh nhân']);

        $admin->givePermissionTo($view_patient);
        $admin->givePermissionTo($create_patient);
        $admin->givePermissionTo($edit_patient);
        $admin->givePermissionTo($delete_patient);

        $view_health_insurance_card = Permission::create(['name' => 'Xem danh sách thẻ BHYT']);
        $create_health_insurance_card = Permission::create(['name' => 'Thêm thẻ BHYT']);
        $edit_health_insurance_card = Permission::create(['name' => 'Chỉnh sửa thẻ BHYT']);
        $delete_health_insurance_card = Permission::create(['name' => 'Xóa thẻ BHYT']);

        $admin->givePermissionTo($view_health_insurance_card);
        $admin->givePermissionTo($create_health_insurance_card);
        $admin->givePermissionTo($edit_health_insurance_card);
        $admin->givePermissionTo($delete_health_insurance_card);

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

        $view_cashier_health_certificate = Permission::create(['name' => 'Xem thu ngân giấy khám bệnh']);
        $view_cashier_service_voucher = Permission::create(['name' => 'Xem thu ngân phiếu dịch vụ']);
        $confirm_payment_health_certificate = Permission::create(['name' => 'Xác nhận thanh toán giấy khám bệnh']);
        $confirm_payment_service_voucher = Permission::create(['name' => 'Xác nhận thanh toán phiếu dịch vụ']);

        $admin->givePermissionTo($view_cashier_health_certificate);
        $admin->givePermissionTo($view_cashier_service_voucher);
        $admin->givePermissionTo($confirm_payment_health_certificate);
        $admin->givePermissionTo($confirm_payment_service_voucher);



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

        $view_device = Permission::create(['name' => 'Xem danh sách thiết bị']);
        $create_device = Permission::create(['name' => 'Thêm thiết bị']);
        $edit_device = Permission::create(['name' => 'Chỉnh sửa thiết bị']);
        $delete_device = Permission::create(['name' => 'Xóa thiết bị']);

        $admin->givePermissionTo($view_device);
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
    }
}
