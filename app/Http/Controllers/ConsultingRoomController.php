<?php

namespace App\Http\Controllers;

use App\Models\ConsultingRoom;
use Illuminate\Http\Request;
use App\Http\Requests\StoreConsultingRoomRequest;
use DB;

class ConsultingRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $consulting_rooms = ConsultingRoom::paginate(10);

        if ($request->search) {
            $consulting_rooms = ConsultingRoom::where('name', 'like', '%'.$request->search.'%')->paginate(10);
            $consulting_rooms->appends(['search' => $request->search]);
        }

        $data = [
            'consulting_rooms' => $consulting_rooms
        ];

        return view('consulting-room.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('consulting-room.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreConsultingRoomRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $create = ConsultingRoom::create([
                'code' => '',
                'name' => $request->name,
            ]);

            $create->update([
                'code' => 'PK'.str_pad($create->id, 6, '0', STR_PAD_LEFT)
            ]);
            
            DB::commit();
            return redirect()->route('consulting_rooms.index')->with('alert-success','Thêm phòng khám thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm phòng khám thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConsultingRoom  $consultingRoom
     * @return \Illuminate\Http\Response
     */
    public function show(ConsultingRoom $consultingRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ConsultingRoom  $consultingRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(ConsultingRoom $consultingRoom)
    {
        $data = [
            'data_edit' => $consultingRoom
        ];

        return view('consulting-room.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConsultingRoom  $consultingRoom
     * @return \Illuminate\Http\Response
     */
    public function update(StoreConsultingRoomRequest $request, ConsultingRoom $consultingRoom)
    {
        try {
            DB::beginTransaction();

            $consultingRoom->update([
                'name' => $request->name,
            ]);
            
            DB::commit();
            return redirect()->route('consulting_rooms.index')->with('alert-success','Sửa phòng khám thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Sửa phòng khám thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConsultingRoom  $consultingRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsultingRoom $consultingRoom)
    {
        try {
            DB::beginTransaction();

            if ($consultingRoom->healthCertifications->count() > 0) {
                return redirect()->back()->with('alert-error','Xóa phòng khám thất bại! Phòng khám '.$consultingRoom->name.' đang có giấy khám bệnh.');
            }

            $consultingRoom->destroy($consultingRoom->id);
            
            DB::commit();
            return redirect()->route('consulting_rooms.index')->with('alert-success','Xóa phòng khám thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa phòng khám thất bại!');
        }
    }
}
