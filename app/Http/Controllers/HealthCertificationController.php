<?php

namespace App\Http\Controllers;

use App\Models\HealthCertification;
use App\Models\Patient;
use App\Models\ConsultingRoom;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHealthCertificationRequest;
use App\Http\Requests\UpdateHealthCertificationRequest;
use DB;
use Illuminate\Database\Eloquent\Builder;

class HealthCertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $health_certifications = HealthCertification::paginate(10);

        if ($request->search) {
            $health_certifications = HealthCertification::whereHas('patient', function (Builder $query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%');
            })->paginate(10);
            $health_certifications->appends(['search' => $request->search]);
        }

        $data = [
            'health_certifications' => $health_certifications
        ];

        return view('health-certification.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Patient::all();
        $consulting_rooms = ConsultingRoom::all();
        $users = User::all();

        $data = [
            'patients' => $patients,
            'consulting_rooms' => $consulting_rooms,
            'users' => $users,
        ];

        return view('health-certification.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHealthCertificationRequest $request)
    {
        $is_health_insurance_card = $request->is_health_insurance_card ? 1 : 0;

        $health_certifications = HealthCertification::whereBetween('created_at', [date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')])->get();
        if ($health_certifications->count() == 0) {
            $number = 1;
        }
        else {
            $number = $health_certifications->last()->number + 1;
        }

        try {
            DB::beginTransaction();

            $create = HealthCertification::create([
                'code' => '',
                'title' => $request->title,
                'patient_id' => $request->patient_id,
                'consulting_room_id' => $request->consulting_room_id,
                'user_id' => $request->user_id,
                'status' => 0,
                'number' => $number,
                'total_money' => $request->total_money,
                'is_health_insurance_card' => $is_health_insurance_card,
            ]);

            $create->update([
                'code' => 'GKB'.str_pad($create->id, 6, '0', STR_PAD_LEFT)
            ]);
            
            DB::commit();
            return redirect()->route('health_certifications.index')->with('alert-success','Thêm giấy khám bệnh thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm giấy khám bệnh thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HealthCertification  $healthCertification
     * @return \Illuminate\Http\Response
     */
    public function show(HealthCertification $healthCertification)
    {
        $patients = Patient::all();
        $consulting_rooms = ConsultingRoom::all();
        $users = User::all();

        $data = [
            'patients' => $patients,
            'consulting_rooms' => $consulting_rooms,
            'users' => $users,
            'data_edit' => $healthCertification,
        ];

        return view('health-certification.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HealthCertification  $healthCertification
     * @return \Illuminate\Http\Response
     */
    public function edit(HealthCertification $healthCertification)
    {
        $patients = Patient::all();
        $consulting_rooms = ConsultingRoom::all();
        $users = User::all();

        $data = [
            'patients' => $patients,
            'consulting_rooms' => $consulting_rooms,
            'users' => $users,
            'data_edit' => $healthCertification,
        ];

        return view('health-certification.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HealthCertification  $healthCertification
     * @return \Illuminate\Http\Response
     */
    public function update(StoreHealthCertificationRequest $request, HealthCertification $healthCertification)
    {
        try {
            DB::beginTransaction();
            
            $healthCertification->update([
                'title' => $request->title,
                'patient_id' => $request->patient_id,
                'consulting_room_id' => $request->consulting_room_id,
                'user_id' => $request->user_id,
                'total_money' => $request->total_money,
            ]);
            
            DB::commit();
            return redirect()->route('health_certifications.index')->with('alert-success','Cập nhật giấy khám bệnh thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Cập nhật giấy khám bệnh thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HealthCertification  $healthCertification
     * @return \Illuminate\Http\Response
     */
    public function destroy(HealthCertification $healthCertification)
    {
        try {
            DB::beginTransaction();

            HealthCertification::destroy($healthCertification->id);
            
            DB::commit();
            return redirect()->route('health_certifications.index')->with('alert-success','Xóa giấy khám bệnh thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa giấy khám bệnh thất bại!');
        }
    }

    public function viewConclude(HealthCertification $healthCertification)
    {
        $data = [
            'data_edit' => $healthCertification,
        ];

        return view('health-certification.conclude', $data);
    }

    public function conclude(UpdateHealthCertificationRequest $request, HealthCertification $healthCertification)
    {
        try {
            DB::beginTransaction();
            
            $healthCertification->update([
                'status' => 1,
                'conclude' => $request->conclude,
                'treatment_guide' => $request->treatment_guide,
                'suggestion' => $request->suggestion,
            ]);
            
            DB::commit();
            return redirect()->route('health_certifications.index')->with('alert-success','Kết luận giấy khám bệnh thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Kết luận giấy khám bệnh thất bại!');
        }
    }

    public function print(HealthCertification $healthCertification)
    {
        $patients = Patient::all();
        $consulting_rooms = ConsultingRoom::all();
        $users = User::all();

        $data = [
            'patients' => $patients,
            'consulting_rooms' => $consulting_rooms,
            'users' => $users,
            'data_edit' => $healthCertification,
        ];

        return view('health-certification.print', $data);
    }
}
