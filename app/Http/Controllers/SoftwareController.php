<?php

namespace App\Http\Controllers;

use App\Models\Software;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSoftwareRequest;
use App\Http\Requests\UpdateSoftwareRequest;
use DB;
use Illuminate\Support\Facades\Storage;

class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $softwares = Software::paginate(10);

        if ($request->search) {
            $softwares = Software::where('name', 'like', '%'.$request->search.'%')->paginate(10);
            $softwares->appends(['search' => $request->search]);
        }

        $data = [
            'softwares' => $softwares
        ];

        return view('software.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('software.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSoftwareRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $file_path_image = '';
            if ($request->file('image')) {
                $name = time().'_'.$request->image->getClientOriginalName();
                $file_path_image = 'uploads/software/image/'.$name;
                Storage::disk('public_uploads')->putFileAs('software/image', $request->image, $name);
            }

            $file_path_file = '';
            if ($request->file('file')) {
                $name = time().'_'.$request->file->getClientOriginalName();
                $file_path_file = 'uploads/software/file/'.$name;
                Storage::disk('public_uploads')->putFileAs('software/file', $request->file, $name);
            }

            $create = Software::create([
                'name' => $request->name,
                'image' => $file_path_image,
                'file' => $file_path_file,
            ]);
            
            DB::commit();
            return redirect()->route('softwares.index')->with('alert-success','Thêm phần mềm hỗ trợ thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm phần mềm hỗ trợ thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function show(Software $software)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function edit(Software $software)
    {
        $data = [
            'data_edit' => $software,
        ];

        return view('software.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSoftwareRequest $request, Software $software)
    {
        try {
            DB::beginTransaction();

            $data = [
                'name' => $request->name,
            ];
            
            if ($request->file('image')) {
                $name = time().'_'.$request->image->getClientOriginalName();
                $file_path_image = 'uploads/software/image/'.$name;
                Storage::disk('public_uploads')->putFileAs('software/image', $request->image, $name);
                $data['image'] = $file_path_image;
            }

            if ($request->file('file')) {
                $name = time().'_'.$request->file->getClientOriginalName();
                $file_path_file = 'uploads/software/file/'.$name;
                Storage::disk('public_uploads')->putFileAs('software/file', $request->file, $name);
                $data['file'] = $file_path_file;
            }

            $software->update($data);
            
            DB::commit();
            return redirect()->route('softwares.index')->with('alert-success','Sửa phần mềm hỗ trợ thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Sửa phần mềm hỗ trợ thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function destroy(Software $software)
    {
        try {
            DB::beginTransaction();

            $software->destroy($software->id);
            
            DB::commit();
            return redirect()->route('softwares.index')->with('alert-success','Xóa phần mềm hỗ trợ thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa phần mềm hỗ trợ thất bại!');
        }
    }
}
