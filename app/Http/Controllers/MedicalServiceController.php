<?php

namespace App\Http\Controllers;

use App\Models\MedicalService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMedicalServiceRequest;
use DB;

class MedicalServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $medical_services = MedicalService::paginate(10);

        if ($request->search) {
            $medical_services = MedicalService::where('name', 'like', '%'.$request->search.'%')->paginate(10);
            $medical_services->appends(['search' => $request->search]);
        }

        $data = [
            'medical_services' => $medical_services
        ];

        return view('medical-service.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medical-service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMedicalServiceRequest $request)
    {
        // dd($request);
        try {
            DB::beginTransaction();
            
            $create = MedicalService::create([
                'code' => '',
                'name' => $request->name,
                'price' => $request->price,
            ]);

            $create->update([
                'code' => 'DV'.str_pad($create->id, 6, '0', STR_PAD_LEFT)
            ]);
            
            DB::commit();
            return redirect()->route('medical_services.index')->with('alert-success','Thêm dịch vụ khám thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm dịch vụ khám thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicalService  $medicalService
     * @return \Illuminate\Http\Response
     */
    public function show(MedicalService $medicalService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicalService  $medicalService
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicalService $medicalService)
    {
        $data = [
            'data_edit' => $medicalService
        ];

        return view('medical-service.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicalService  $medicalService
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMedicalServiceRequest $request, MedicalService $medicalService)
    {
        try {
            DB::beginTransaction();

            $medicalService->update([
                'name' => $request->name,
                'price' => $request->price,
            ]);
            
            DB::commit();
            return redirect()->route('medical_services.index')->with('alert-success','Sửa dịch vụ khám thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Sửa dịch vụ khám thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicalService  $medicalService
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicalService $medicalService)
    {
        try {
            DB::beginTransaction();

            if ($medicalService->serviceVouchers->count() > 0) {
                return redirect()->back()->with('alert-error','Xóa dịch vụ khám thất bại! Dịch vụ khám '.$medicalService->name.' đang có phiếu dịch vụ.');
            }

            $medicalService->destroy($medicalService->id);
            
            DB::commit();
            return redirect()->route('medical_services.index')->with('alert-success','Xóa dịch vụ khám thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa dịch vụ khám thất bại!');
        }
    }
}
