<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Exports\PermissionExport;
use App\Imports\PermissionImport;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class RoleController extends Controller
{
    // Permission Methods
    public function AllPermission()
    {
        $permission = Permission::all();
        return view('admin.permission.show_permission',compact('permission'));
    }


    public function AddPermission()
    {
        return view('admin.permission.add_permission');
    }


    public function StorePermission(Request $request)
    {
        Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);
        $notification = array(
            'message' => 'Permission Added Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    }


    public function EditPermission($id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin.permission.edit_permission',compact('permission'));
    }


    public function UpdatePermission(Request $request)
    {
        $rpid = $request->id;
        Permission::findOrFail($rpid)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);
        $notification = array(
            'message' => 'Permission Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    }


    public function DeletePermission($id)
    {
        Permission::findOrFail($id)->delete();
        
        $notification = array(
            'message' => 'Permission Deleted Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    // Excel Methods
    public function ImportPermission()
    {
        return view('admin.permission.import_permission');
    }


    public function Download()
    {
        return Excel::download(new PermissionExport, 'permission.xlsx');
    }


    public function Import(Request $request)
    {
        Excel::import(new PermissionImport, $request->file('import_file'));
        $notification = array(
            'message' => 'Permission Imported Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    // Role Methods
    public function AllRole()
    {
        $role = Role::all();
        return view('admin.role.show_role',compact('role'));
    }


    public function AddRole()
    {
        return view('admin.role.add_role');
    }


    public function StoreRole(Request $request)
    {
        Role::create([
            'name' => $request->name,
        ]);
        $notification = array(
            'message' => 'Role Added Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('all.role')->with($notification);
    }


    public function EditRole($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.role.edit_role',compact('role'));
    }


    public function UpdateRole(Request $request)
    {
        $rid = $request->id;
        Role::findOrFail($rid)->update([
            'name' => $request->name,
        ]);
        $notification = array(
            'message' => 'Role Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('all.role')->with($notification);
    }


    public function DeleteRole($id)
    {
        Role::findOrFail($id)->delete();
        
        $notification = array(
            'message' => 'Role Deleted Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    // Role in permission Methods
    public function AddRoleInPermission()
    {
        $role = Role::all();
        $permission = Permission::all();
        $permission_group = User::getPermissionGroups();
        return view('admin.rolesetup.add_role_permission',compact('role','permission','permission_group'));
    }


    public function StoreRolePermission(Request $request)
    {
        $data = array();
        $permission = $request->permission;
        foreach($permission as $key => $item)
        {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;
            DB::table('role_has_permissions')->insert($data);
        }
        $notification = array(
            'message' => 'Role Permission Added Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('all.role.permission')->with($notification);
    }


    public function AllRoleInPermission()
    {
        $role = Role::all();
        return view('admin.rolesetup.all_role_permission',compact('role'));
    }


    public function EditRoleInPermission($id)
    {
        $role = Role::findOrFail($id);
        $permission = Permission::all();
        $permission_group = User::getPermissionGroups();
        return view('admin.rolesetup.edit_role_permission',compact('role','permission','permission_group'));
    }


    public function UpdateRoleInPermission(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
            $permissionNames = Permission::whereIn('id', $permissions)->pluck('name');
            $role->syncPermissions($permissionNames);
        }

        $notification = array(
            'message' => 'Role Permission Updated Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.role.permission')->with($notification);
    }


    public function DeleteRoleInPermission($id)
    {
        $role = Role::findOrFail($id);
        if (!is_null($role)) 
        {
            $role->delete();
        }
        
        $notification = array(
            'message' => 'Role Permission Deleted Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
