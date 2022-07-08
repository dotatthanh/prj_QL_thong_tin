<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DB;
use App\Http\Requests\StoreRoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::paginate(10);

        if ($request->search) {
            $roles = Role::where('name', 'like', '%'.$request->search.'%')->paginate(10);
            $roles->appends(['search' => $request->search]);
        }

        $data = [
            'roles' => $roles
        ];

        return view('role.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        try {
            DB::beginTransaction();

            $create = Role::create([
                'name' => $request->name,
                'guard_name' => 'web',
            ]);

            DB::commit();
            return redirect()->route('roles.index')->with('alert-success','Thêm vai trò thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm vai trò thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        $data = [
            'data_edit' => $role,
        ];

        return view('role.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRoleRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $update = Role::findOrFail($id)->update([
                'name' => $request->name,
            ]);

            DB::commit();
            return redirect()->route('roles.index')->with('alert-success','Cập nhật vai trò thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Cập nhật vai trò thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $role = Role::findOrFail($id);

            if ($role->users->count() > 0) {
                return redirect()->back()->with('alert-error','Xóa vai trò thất bại! Vai trò '.$role->name.' đang có tài khoản.');
            }
            elseif ($role->permissions->count() > 0) {
                return redirect()->back()->with('alert-error','Xóa vai trò thất bại! Vai trò '.$role->name.' đang có quyền.');
            }

            $role->destroy($id);
            DB::commit();
            return redirect()->route('roles.index')->with('alert-success','Xóa vai trò thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa vai trò thất bại!');
        }
    }
}
