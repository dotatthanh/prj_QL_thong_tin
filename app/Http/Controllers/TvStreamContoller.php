<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Unit;
use App\Models\Station;
use App\Models\TvStream;
use Illuminate\Http\Request;
use DB;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TvStreamImport;

class TvStreamContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tv_streams = TvStream::query();
        if (isset($request->search) || isset($request->device_id)) {
            if (isset($request->search)) {
                $tv_streams = $tv_streams->where('thread_label', 'like', '%'.$request->search.'%');
            }

            if (isset($request->device_id)) {
                $tv_streams = $tv_streams->where('device_id', $request->device_id);
            }
            $tv_streams = $tv_streams->paginate(50)->appends([
                'search' => $request->search,
                'device_id' => $request->device_id,
            ]);
        }

        if (auth()->user()->hasRole('Admin')) {
            $data = Unit::where('parent_id', null)->first();
            $dataList = [];
            if ($data) {
                $dataList = [
                    'id' => $data->id,
                    'parent_id' => $data->parent_id,
                    'name' => $data->name,
                    'childs' => [],
                ];
                $parents = Unit::where('parent_id', $dataList['id'])->get();
                if(!empty($parents)){
                    foreach($parents as $keyParent => $parent){
                        $stations = Station::where('unit_id', $parent->id)->get();
                        array_push($dataList['childs'],[
                            'id' => $parent->id,
                            'parent_id' => $parent->parent_id,
                            'name' => $parent->name,
                            'count_child' => $parents->count() + $stations->count(),
                            'childs' => [],
                            'station_childs' => $stations->toArray(),
                        ]);
                        $parent_lv3 = Unit::where('parent_id', $parent['id'])->get();
                        if(!empty($parent_lv3)){
                            foreach($parent_lv3 as $lv3) {
                                $count_child = \DB::table('units as unit')
                                ->where('unit.parent_id', $lv3['id'])
                                ->count();

                                $count_station = Station::where('unit_id', $lv3['id'])->count();

                                array_push($dataList['childs'][$keyParent]['childs'],[
                                    'id' => $lv3->id,
                                    'parent_id' => $lv3->parent_id,
                                    'name' => $lv3->name,
                                    'count_child' => $count_child + $count_station,
                                ]);
                            }
                        }
                    }
                }
            }
        }
        else {
            $unitParent = Unit::find(auth()->user()->unit->parent_id);
            $unit = Unit::find(auth()->user()->unit_id);
            $stations = Station::where('unit_id', $unit->id)->get();

            if(!empty($unitParent)){
                $dataList = [
                    'id' => $unitParent->id,
                    'parent_id' => $unitParent->parent_id,
                    'name' => $unitParent->name,
                    'childs' => [
                        [
                            'id' => $unit->id,
                            'parent_id' => $unit->parent_id,
                            'name' => $unit->name,
                            'count_child' => 1 + $stations->count(),
                            'childs' => [],
                            'station_childs' => $stations->toArray(),
                        ]
                    ]
                ];
                $parent_lv3 = Unit::where('parent_id', $unit['id'])->get();
                if(!empty($parent_lv3)){
                    foreach($parent_lv3 as $lv3) {
                        $count_child = \DB::table('units as unit')
                        ->where('unit.parent_id', $lv3['id'])
                        ->count();

                        $count_station = Station::where('unit_id', $lv3['id'])->count();

                        array_push($dataList['childs'][0]['childs'],[
                            'id' => $lv3->id,
                            'parent_id' => $lv3->parent_id,
                            'name' => $lv3->name,
                            'count_child' => $count_child + $count_station,
                        ]);
                    }
                }
            }
        }

        $data = [
            'dataList' => $dataList,
            'tv_streams' => $tv_streams,
            'request' => $request,
        ];

        return view('tv-stream.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = [
            'request' => $request,
        ];

        return view('tv-stream.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $device = Device::find($request->device_id);

            for ($port_origin=0; $port_origin < $request->port_origin; $port_origin++) { 
                $create = TvStream::create([
                    'station_id' => $device->station->id,
                    'device_id' => $device->id,
                    'name_card' => $request->name_card,
                    'port_origin' => $port_origin+1,
                    'signal_type' => $request->signal_type,
                    'coordinates_origin' => $request->coordinates_origin,
                    'thread_label' => $request->thread_label[$port_origin],
                    'service' => $request->service[$port_origin],
                    'station' => $request->station[$port_origin],
                    'device' => $request->device[$port_origin],
                    'coordinates_remote' => $request->coordinates_remote[$port_origin],
                    'port_remote' => $request->port_remote[$port_origin],
                    'note' => $request->note[$port_origin],
                    'port_station' => $request->port_station[$port_origin],
                    'coordinates_station' => $request->coordinates_station[$port_origin],
                    'device_station' => $request->device_station[$port_origin],
                ]);
            }
            
            DB::commit();
            return redirect()->route('tv_streams.index', ['device_id' => $request->device_id])->with('alert-success','Thêm card thiết bị thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm card thiết bị thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TvStream  $tvStream
     * @return \Illuminate\Http\Response
     */
    public function show(TvStream $tvStream)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TvStream  $tvStream
     * @return \Illuminate\Http\Response
     */
    public function edit(TvStream $tvStream)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TvStream  $tvStream
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TvStream $tvStream)
    {
        try {
            DB::beginTransaction();

            $tvStream->update([
                'signal_type' => $request->signal_type,
                'port_origin' => $request->port_origin,
                'coordinates_origin' => $request->coordinates_origin,
                'name_card' => $request->name_card,
                'thread_label' => $request->thread_label,
                'service' => $request->service,
                'station' => $request->station,
                'device' => $request->device,
                'coordinates_remote' => $request->coordinates_remote,
                'port_remote' => $request->port_remote,
                'note' => $request->note,
                'port_station' => $request->port_station,
                'coordinates_station' => $request->coordinates_station,
                'device_station' => $request->device_station,
            ]);
            
            DB::commit();
            return redirect()->back()->with('alert-success','Sửa card thiết bị thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Sửa card thiết bị thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TvStream  $tvStream
     * @return \Illuminate\Http\Response
     */
    public function destroy(TvStream $tvStream)
    {
        try {
            DB::beginTransaction();

            $tvStream->destroy($tvStream->id);
            
            DB::commit();
            return redirect()->back()->with('alert-success','Xóa luồng TH-TSL thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa luồng TH-TSL thất bại!');
        }
    }

    public function print(Request $request)
    {
        $tv_streams = TvStream::query();
        if (isset($request->search) || isset($request->device_id)) {
            if (isset($request->search)) {
                $tv_streams = $tv_streams->where('thread_label', 'like', '%'.$request->search.'%');
            }

            if (isset($request->device_id)) {
                $tv_streams = $tv_streams->where('device_id', $request->device_id);
            }
            $tv_streams = $tv_streams->get();
        }

        $data = [
            'tv_streams' => $tv_streams,
        ];

        $pdf = PDF::loadView('tv-stream.pdf', $data)->setPaper('a2', 'landscape');
    
        return $pdf->download('luong_th_tdl.pdf');
    }

    public function importExcel(Request $request) {
        try {
            DB::beginTransaction();
            $import = new TvStreamImport();
            $import->import($request->file('file'), null, \Maatwebsite\Excel\Excel::XLSX);

            DB::commit();
            return back()->with('alert-success', 'Nhập danh sách luồng truyền hình - truyền số liệu thành công.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            DB::rollback();
            $failures = collect($e->failures());
            return back()->with('failures', $failures);
        }

    }
}
