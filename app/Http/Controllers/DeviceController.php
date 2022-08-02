<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use App\Models\Unit;
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
        $units = Unit::getTreeUnit([auth()->user()->unit_id])->pluck('id')->toArray();
        $stations = Station::whereIn('unit_id', $units)->pluck('id')->toArray();
        $devices = Device::whereIn('station_id', $stations);

        if ($request->search) {
            $devices = $devices->where('name', 'like', '%'.$request->search.'%');
        }

        $devices = $devices->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'devices' => $devices
        ];

        return view('device.index', $data);
    }

    public function transmission($id, Request $request)
    {
        $devices = Device::where('station_id', $id)->where('type', 1);

        if ($request->search) {
            $devices = $devices->where('name', 'like', '%'.$request->search.'%');
        }

        $devices = $devices->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'devices' => $devices,
            'type' => 1,
            'id' => $id,
        ];

        return view('device.index', $data);
    }

    public function television($id, Request $request)
    {
        $devices = Device::where('station_id', $id)->where('type', 2);

        if ($request->search) {
            $devices = $devices->where('name', 'like', '%'.$request->search.'%');
        }

        $devices = $devices->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'devices' => $devices,
            'type' => 2,
            'id' => $id,
        ];

        return view('device.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $units = Unit::getTreeUnit([auth()->user()->unit_id])->pluck('id')->toArray();
        $stations = Station::whereIn('unit_id', $units)->get();

        $data = [
            'stations' => $stations,
            'type' => $request->type,
            'id' => $request->id,
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
                'type' => $request->type,
            ]);
            
            DB::commit();
            if ($request->type == 1)
                return redirect()->route('device.transmission', $request->id)->with('alert-success','Thêm thiết bị thành công!');
            return redirect()->route('device.television', $request->id)->with('alert-success','Thêm thiết bị thành công!');
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
    public function edit(Device $device, Request $request)
    {
        $units = Unit::getTreeUnit([auth()->user()->unit_id])->pluck('id')->toArray();
        $stations = Station::whereIn('unit_id', $units)->get();

        $data = [
            'data_edit' => $device,
            'stations' => $stations,
            'type' => $request->type,
            'id' => $request->id,
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
            if ($request->type == 1)
                return redirect()->route('device.transmission', $request->id)->with('alert-success','Sửa thiết bị thành công!');
            return redirect()->route('device.television', $request->id)->with('alert-success','Sửa thiết bị thành công!');
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

    public function getDeviceTransmissionByStation(Request $request)
    {
        $devices = Device::where('station_id', $request->id)->where('type', 1)->get();

        return \response()->json([
            'devices' => $devices,
            'count' => $devices->count(),
        ]);
    }

    public function getDeviceTelevisionByStation(Request $request)
    {
        $devices = Device::where('station_id', $request->id)->where('type', 2)->get();

        return \response()->json([
            'devices' => $devices,
            'count' => $devices->count(),
        ]);
    }

    public function getDeviceByStation(Request $request)
    {
        $devices = Device::where('station_id', $request->id)->get();

        return \response()->json([
            'devices' => $devices,
            'count' => $devices->count(),
        ]);
    }
}
