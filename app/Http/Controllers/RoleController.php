<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Permission_role;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    protected $roleRepository;
    protected $permissionRepository;
    public function __construct(RoleRepositoryInterface $roleRepository,PermissionRepositoryInterface $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    function index(){
        return view('admin.role.index');
    }

    function getdata(){
        $role = $this->roleRepository->getAll();
        return DataTables::of($role)
            ->addColumn('action', function($role){
                return view('admin.role.table.action', ['role' => $role])->render();
            })
            ->make(true);
    }

    function getdataPermission()
    {
        $permission = $this->permissionRepository->getAll();
        return DataTables::of($permission)
            ->addColumn('action', function ($permission) {
                return view('admin.role.table.checkbox', compact('permission'))->render();
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = $this->permissionRepository->getAll();
        return view('admin.role.create',compact('permission'));
    }

    public function store(Request $request)
    {
        $input = $request->checkPermission;
        $role = $this->roleRepository->create($request->all());
        $role->permission()->attach($input);
        return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->roleRepository->getById($id);
        return view('admin.role.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->roleRepository->getById($id);
        $permission = $this->permissionRepository->getAll();
        $arr_permissionId = [];
        foreach ($role->permission as $item)
        {
            array_push($arr_permissionId, $item->id);
        }
        return view('admin.role.edit',compact('role','arr_permissionId', 'permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $input = $request -> checkPermission;
        $this->roleRepository->update($id,$request->all());
        $this->roleRepository->sync($id,$input);
        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->roleRepository->detach($id);
        $this->roleRepository->delete($id);
        return back();
    }
}
