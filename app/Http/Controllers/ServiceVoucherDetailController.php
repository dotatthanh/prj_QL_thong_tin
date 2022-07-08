<?php

namespace App\Http\Controllers;

use App\Models\ServiceVoucher;
use App\Models\ServiceVoucherDetail;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests\StoreServiceVoucherDetailRequest;

class ServiceVoucherDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $service_voucher = ServiceVoucher::findOrFail($request->service_voucher_id);

        $data = [
            'service_voucher' => $service_voucher,
        ];

        return view('service-voucher-detail.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceVoucherDetailRequest $request)
    {
        try {
            DB::beginTransaction();
            $service_voucher = ServiceVoucher::findOrFail($request->service_voucher_id);
            $check_medical_examination_day = ServiceVoucherDetail::where('service_voucher_id', $request->service_voucher_id)->where('date', date("Y-m-d", strtotime($request->date)))->count();

            // check ngày đã kết luận chưa
            if ($check_medical_examination_day) {
                return redirect()->back()->with('alert-error', 'Cập nhật chi tiết phiếu dịch vụ thất bại! Ngày '.$request->date.' đã có kết luận khám!');
            }

            // Check ngày khám theo ngày bắt đầu và kết thúc
            if (date("Y-m-d", strtotime($request->date)) >= $service_voucher->start_date && date("Y-m-d", strtotime($request->date)) <= $service_voucher->end_date) {
                $create = ServiceVoucherDetail::create([
                    'date' => date("Y-m-d", strtotime($request->date)),
                    'result' => $request->result,
                    'service_voucher_id' => $request->service_voucher_id,
                ]);
            }
            else {
                return redirect()->back()->with('alert-error','Thêm chi tiết phiếu dịch vụ thất bại! Ngày khám không hợp lệ!');
            }
            
            DB::commit();
            return redirect()->route('service_vouchers.index')->with('alert-success','Thêm chi tiết phiếu dịch vụ thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm chi tiết phiếu dịch vụ thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceVoucherDetail  $serviceVoucherDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceVoucherDetail $serviceVoucherDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceVoucherDetail  $serviceVoucherDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceVoucherDetail $serviceVoucherDetail)
    {
        $data = [
            'data_edit' => $serviceVoucherDetail,
            'service_voucher' => $serviceVoucherDetail->serviceVoucher,
        ];

        return view('service-voucher-detail.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceVoucherDetail  $serviceVoucherDetail
     * @return \Illuminate\Http\Response
     */
    public function update(StoreServiceVoucherDetailRequest $request, ServiceVoucherDetail $serviceVoucherDetail)
    {
        try {
            DB::beginTransaction();


            $service_voucher = $serviceVoucherDetail->serviceVoucher;

            $check_medical_examination_day = $serviceVoucherDetail->serviceVoucher->serviceVoucherDetails()->where('date', date("Y-m-d", strtotime($request->date)))->whereNotIn('id', [$serviceVoucherDetail->id])->count();

            // check ngày đã kết luận chưa
            if ($check_medical_examination_day) {
                return redirect()->back()->with('alert-error', 'Cập nhật chi tiết phiếu dịch vụ thất bại! Ngày '.$request->date.' đã có kết luận khám!');
            }

            // Check ngày khám theo ngày bắt đầu và kết thúc
            if (date("Y-m-d", strtotime($request->date)) >= $service_voucher->start_date && date("Y-m-d", strtotime($request->date)) <= $service_voucher->end_date) {
                $serviceVoucherDetail->update([
                    'date' => date("Y-m-d", strtotime($request->date)),
                    'result' => $request->result,
                ]);
            }
            else {
                return redirect()->back()->with('alert-error', 'Cập nhật chi tiết phiếu dịch vụ thất bại! Ngày khám không hợp lệ!');
            }

            DB::commit();
            return redirect()->route('service_vouchers.edit', $serviceVoucherDetail->serviceVoucher->id)->with('alert-success', 'Cập nhật chi tiết phiếu dịch vụ thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error', 'Cập nhật chi tiết phiếu dịch vụ thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceVoucherDetail  $serviceVoucherDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceVoucherDetail $serviceVoucherDetail)
    {
        
    }

    public function delete(ServiceVoucherDetail $serviceVoucherDetail)
    {
        try {
            DB::beginTransaction();

            ServiceVoucherDetail::destroy($serviceVoucherDetail->id);

            DB::commit();
            return redirect()->back()->with('alert-success', 'Xóa phiếu dịch vụ thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error', 'Xóa phiếu dịch vụ thất bại!');
        }
    }
}
