<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUnitRequest;
use DB;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $units = Unit::getTreeUnit([auth()->user()->unit_id]);

        if ($request->search) {
            $units = $units->where('name', 'like', '%'.$request->search.'%');
        }

        $units = $units->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'units' => $units
        ];

        return view('unit.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::getTreeUnit([auth()->user()->unit_id])->paginate(10);

        $data = [
            'units' => $units,
        ];

        return view('unit.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUnitRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $create = Unit::create([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
            ]);
            
            DB::commit();
            return redirect()->route('units.index')->with('alert-success','Thêm đơn vị BĐKT thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm đơn vị BĐKT thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        $units = Unit::getTreeUnit([auth()->user()->unit_id])->where('id', '!=', $unit->id)->paginate(10);

        $data = [
            'data_edit' => $unit,
            'units' => $units,
        ];

        return view('unit.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUnitRequest $request, Unit $unit)
    {
        try {
            DB::beginTransaction();

            $unit->update([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
            ]);
            
            DB::commit();
            return redirect()->route('units.index')->with('alert-success','Sửa đơn vị BĐKT thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Sửa đơn vị BĐKT thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        try {
            DB::beginTransaction();

            if ($unit->stations->count() > 0) {
                return redirect()->back()->with('alert-error','Xóa đơn vị BĐKT thất bại! Đơn vị BĐKT '.$unit->name.' đang có dữ liệu trạm.');
            }

            $check_child_unit = Unit::where('parent_id', $unit->id)->exists();
            if ($check_child_unit) {
                return redirect()->back()->with('alert-error','Xóa đơn vị BĐKT thất bại! Đơn vị BĐKT '.$unit->name.' đang có dữ liệu đơn vị BĐKT cấp dưới.');
            }

            $unit->destroy($unit->id);
            
            DB::commit();
            return redirect()->route('units.index')->with('alert-success','Xóa đơn vị BĐKT thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa đơn vị BĐKT thất bại!');
        }
    }
}
