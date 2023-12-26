<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionController extends Controller
{
    public function index()  : View {
        $roles = Role::all();
        $permissions = Permission::all()->groupBy('group_name');
        // dd($permissions);
        return view('admin.role.index',compact('roles','permissions'));
    }

    public function create()/**  : Returntype */ {

    }

    public function store(Request $data) : Response {
        $data->validate([
            'role_name' => 'required|max:55|unique:roles,name',
        ]);
        $role = Role::create(['guard_name' => 'web', 'name' => $data->role_name]);
        $role->syncPermissions($data->permissions);
        // dd($role);
        return response([
            'role'=>$role,
            'permissions' => DB::table('role_has_permissions')->join('permissions','role_has_permissions.permission_id','permissions.id')->where('role_id',$role->id)->select('permissions.name')->get(),
        ],200);
    } 
    
    public function edit(Request $data) : Response {
        $role = Role::findOrFail($data->id);
        $permissions = Permission::all()->groupBy('group_name');
        $rolePermissions = $role->permissions;
        $rolePermissions = $rolePermissions->pluck('name')->toArray();
        // dd($rolePermissions);
        return response([
            'role'=>$role,
            'permissions'=>$permissions,
            'rolePermissions'=>$rolePermissions,
        ],200);
    }

    public function update(Request $data, string $id) : Response {
        // dd($data->all());
        $data->validate([
            'role_name' => 'required|max:55|unique:roles,name,'.$id,
        ]);

        $role = Role::findOrFail($id);
        $role->update(['guard_name' => 'web', 'name' => $data->role_name]);
        $role->syncPermissions($data->permissions);
        $rolePermissions = $role->permissions;
        $rolePermissions = $rolePermissions->pluck('name')->toArray();
        return response([
            'role' => $role,
            'rolePermissions' => $rolePermissions,
        ]);
    }

    public function destroy(string $id) : Response {
        $role = Role::findOrFail($id);
        if($role->name==='Super Admin'){
            return response(['status'=>'warning','title'=>__('admin_local.Warning !'),'text'=>__("admin_local.Can't delete this role . Sorry !"),'confirmTextButton'=>__('admin_local.Ok')],422);
        }
        $role->delete();
        return response(['title'=>__('admin_local.Congratulations !'),'text'=>__('admin_local.Role removed successfully') ,'confirmTextButton'=>__('admin_local.Ok')],200);
    }
}
