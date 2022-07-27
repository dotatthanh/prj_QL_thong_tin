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
        $units = Unit::getTreeUnit([auth()->user()->unit_id])->pluck('id')->toArray();
        $stations = Station::whereIn('unit_id', $units);

        if ($request->search) {
            $stations = $stations->where('name', 'like', '%'.$request->search.'%');
        }
        $stations = $stations->paginate(10)->appends(['search' => $request->search]);

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
        $units = Unit::getTreeUnit([auth()->user()->unit_id])->get();

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
        $data = [
            'station' => $station
        ];
        
        return view('station.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function edit(Station $station)
    {
        $units = Unit::getTreeUnit([auth()->user()->unit_id])->get();

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

    public function systemTree()
    {
        if (auth()->user()->hasRole('Admin')) {
            $data = Unit::where('parent_id', null)->first();
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
        ];

        return view('station.system-tree', $data);
    }

    public function getUnitChildList(Request $request){
        $parents = Unit::where('parent_id', $request->id)->get();
        $dataList = [];
        if(!empty($parents)){
            foreach($parents as $parent) {
                $count_child = \DB::table('units as unit')
                ->where('unit.parent_id', $parent['id'])
                ->count();
                array_push($dataList,[
                    'id' => $parent->id,
                    'parent_id' => $parent->parent_id,
                    'name' => $parent->name,
                    'count_child' => $count_child,
                ]);
            }
        }

        return \response()->json([
            'status'=> 1,
            'data_unit' => $dataList,
            'data_station' => Station::where('unit_id', $request->id)->get(),
        ]);
    }
}
