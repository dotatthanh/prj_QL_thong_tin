<?php

namespace App\Http\Controllers;

use App\Models\HealthInsuranceCard;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHealthInsuranceCardRequest;
use DB;
use Illuminate\Database\Eloquent\Builder;

class HealthInsuranceCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $health_insurance_cards = HealthInsuranceCard::paginate(10);

        if ($request->search) {
            $health_insurance_cards = HealthInsuranceCard::whereHas('patient', function (Builder $query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%');
            })->paginate(10);
            $health_insurance_cards->appends(['search' => $request->search]);
        }

        $data = [
            'health_insurance_cards' => $health_insurance_cards
        ];

        return view('health-insurance-card.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Patient::all();

        $data = [
            'patients' => $patients,
        ];

        return view('health-insurance-card.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHealthInsuranceCardRequest $request)
    {
        try {
            DB::beginTransaction();
            $patient = Patient::findOrFail($request->patient_id);

            if ($patient->healthInsuranceCard) {
                return redirect()->back()->with('alert-error','Thêm thẻ BHYT thất bại! Bệnh nhân '.$patient->name.' đã có thẻ BHYT.');
            }

            $create = HealthInsuranceCard::create([
                'code' => '',
                'patient_id' => $request->patient_id,
                'hospital' => $request->hospital,
                'use_value' => date("Y-m-d", strtotime($request->use_value)),
                'id_card' => $request->id_card,
                'date_of_issue' => date("Y-m-d", strtotime($request->date_of_issue)),
                'issued_by' => $request->issued_by,
            ]);

            $create->update([
                'code' => 'BHYT'.str_pad($create->id, 6, '0', STR_PAD_LEFT)
            ]);
            
            DB::commit();
            return redirect()->route('health_insurance_cards.index')->with('alert-success','Thêm thẻ BHYT thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm thẻ BHYT thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HealthInsuranceCard  $healthInsuranceCard
     * @return \Illuminate\Http\Response
     */
    public function show(HealthInsuranceCard $healthInsuranceCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HealthInsuranceCard  $healthInsuranceCard
     * @return \Illuminate\Http\Response
     */
    public function edit(HealthInsuranceCard $healthInsuranceCard)
    {
        $patients = Patient::all();

        $data = [
            'data_edit' => $healthInsuranceCard,
            'patients' => $patients
        ];

        return view('health-insurance-card.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HealthInsuranceCard  $healthInsuranceCard
     * @return \Illuminate\Http\Response
     */
    public function update(StoreHealthInsuranceCardRequest $request, HealthInsuranceCard $healthInsuranceCard)
    {
        try {
            DB::beginTransaction();
            
            $healthInsuranceCard->update([
                'patient_id' => $request->patient_id,
                'hospital' => $request->hospital,
                'use_value' => date("Y-m-d", strtotime($request->use_value)),
                'id_card' => $request->id_card,
                'date_of_issue' => date("Y-m-d", strtotime($request->date_of_issue)),
                'issued_by' => $request->issued_by,
            ]);
            
            DB::commit();
            return redirect()->route('health_insurance_cards.index')->with('alert-success','Sửa thẻ BHYT thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Sửa thẻ BHYT thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HealthInsuranceCard  $healthInsuranceCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(HealthInsuranceCard $healthInsuranceCard)
    {
        try {
            DB::beginTransaction();

            HealthInsuranceCard::destroy($healthInsuranceCard->id);
            
            DB::commit();
            return redirect()->route('health_insurance_cards.index')->with('alert-success','Xóa thẻ BHYT thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa thẻ BHYT thất bại!');
        }
    }

    public function getInsuranceCard($id)
    {
        $data = HealthInsuranceCard::where('patient_id', $id)->first();

        if ($data) {
            return true;
        }
        
        return false;
    }
}
