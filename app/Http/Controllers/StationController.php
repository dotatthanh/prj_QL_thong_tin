<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Http\Requests\StoreStationRequest;
use DB;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stations = Station::paginate(10);

        if ($request->search) {
            $stations = Station::where('name', 'like', '%'.$request->search.'%')->paginate(10);
            $stations->appends(['search' => $request->search]);
        }

        $data = [
            'stations' => $stations
        ];

        return view('station.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::all();

        $data = [
            'units' => $units,
        ];

        return view('station.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStationRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $create = Station::create([
                'name' => $request->name,
                'unit_id' => $request->unit_id,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
            ]);
            
            DB::commit();
            return redirect()->route('stations.index')->with('alert-success','Thêm trạm thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm trạm thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function show(Station $station)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function edit(Station $station)
    {
        $units = Unit::all();

        $data = [
            'data_edit' => $station,
            'units' => $units,
        ];

        return view('station.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function update(StoreStationRequest $request, Station $station)
    {
        try {
            DB::beginTransaction();

            $station->update([
                'name' => $request->name,
                'unit_id' => $request->unit_id,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
            ]);
            
            DB::commit();
            return redirect()->route('stations.index')->with('alert-success','Sửa trạm thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Sửa trạm thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function destroy(Station $station)
    {
        try {
            DB::beginTransaction();

            if ($station->devices->count() > 0) {
                return redirect()->back()->with('alert-error','Xóa trạm thất bại! Trạm '.$station->name.' đang có dữ liệu thiết bị.');
            }

            $station->destroy($station->id);
            
            DB::commit();
            return redirect()->route('stations.index')->with('alert-success','Xóa trạm thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa trạm thất bại!');
        }
    }
}
