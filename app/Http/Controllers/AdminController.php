<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    // Admin methods
    public function AdminDashboard()
    {
        return view('admin.index');
    }


    public function AdminLogin()
    {
        return view('admin.login');
    }


    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.adminprofile',compact('profileData'));
    }


    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHis').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;
        }
        $data->save();
        $notification = array(
            'message' => 'Admin Profile Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.adminchangepassword',compact('profileData'));
    }


    public function AdminPasswordStore(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);
        if(!Hash::check($request->old_password, auth::user()->password)){
            $notification = array(
                'message' => 'Old Password Does Not Match!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = array(
            'message' => 'Admin Password Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function AdminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }


    // Admin User Methods
    public function AllAdmin() 
    {
        $alladmin = User::where('role','admin')->get();
        return view('admin.admin&user.all_admin',compact('alladmin'));   
    }


    public function AddAdmin() 
    {
        $role = Role::all();
        return view('admin.admin&user.add_admin',compact('role'));   
    }


    public function StoreAdmin(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();
        if ($request->role) {
            $role = \Spatie\Permission\Models\Role::findById($request->role, 'web');
            $user->assignRole($role);
        }
        $notification = array(
            'message' => 'New Admin Created Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('all.admin')->with($notification);
    }


    public function EditAdmin($id) 
    {
        $user = User::findOrFail($id);
        $role = Role::all();
        return view('admin.admin&user.edit_admin',compact('user','role'));   
    }


    public function UpdateAdmin(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();
        $user->roles()->detach();
        if ($request->role) {
            $role = \Spatie\Permission\Models\Role::findById($request->role, 'web');
            $user->assignRole($role);
        }
        $notification = array(
            'message' => 'Admin Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('all.admin')->with($notification);
    }


    public function DeleteAdmin($id) 
    {
        $user = User::findOrFail($id);
        if (!is_null($user)) 
        {
            $user->delete();
        }
        $notification = array(
            'message' => 'Admin Deleted Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);   
    }
}
