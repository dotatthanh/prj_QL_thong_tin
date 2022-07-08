<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use App\Models\Station;
use App\Http\Requests\StoreDeviceRequest;
use DB;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $devices = Device::paginate(10);

        if ($request->search) {
            $devices = Device::where('name', 'like', '%'.$request->search.'%')->paginate(10);
            $devices->appends(['search' => $request->search]);
        }

        $data = [
            'devices' => $devices
        ];

        return view('device.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stations = Station::all();

        $data = [
            'stations' => $stations,
        ];

        return view('device.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeviceRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $create = Device::create([
                'name' => $request->name,
                'station_id' => $request->station_id,
            ]);
            
            DB::commit();
            return redirect()->route('devices.index')->with('alert-success','Thêm thiết bị thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm thiết bị thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        $stations = Station::all();

        $data = [
            'data_edit' => $device,
            'stations' => $stations,
        ];

        return view('device.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDeviceRequest $request, Device $device)
    {
        try {
            DB::beginTransaction();

            $device->update([
                'name' => $request->name,
                'station_id' => $request->station_id,
            ]);
            
            DB::commit();
            return redirect()->route('devices.index')->with('alert-success','Sửa thiết bị thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Sửa thiết bị thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        try {
            DB::beginTransaction();

            $device->destroy($device->id);
            
            DB::commit();
            return redirect()->route('devices.index')->with('alert-success','Xóa thiết bị thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa thiết bị thất bại!');
        }
    }
}
