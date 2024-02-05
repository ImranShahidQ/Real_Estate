<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyType;
use Illuminate\Support\Facades\Hash;

class PropertyTypeController extends Controller
{
    public function ShowProperty()
    {
        $property = PropertyType::latest()->get();
        return view('admin.property.show_property',compact('property'));
    }


    public function AddProperty()
    {
        return view('admin.property.add_property');
    }


    public function StoreProperty(Request $request)
    {
        $request->validate([
            'type_name' => 'required|unique:property_types|max:200',
            'type_icon' => 'required'
        ]);
        PropertyType::insert([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);
        $notification = array(
            'message' => 'Property Added Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('show.property')->with($notification);
    }


    public function EditProperty($id)
    {
        $property = PropertyType::findOrFail($id);
        return view('admin.property.edit_property',compact('property'));
    }


    public function UpdateProperty(Request $request)
    {
        $pid = $request->id;
        PropertyType::findOrFail($pid)->update([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);
        $notification = array(
            'message' => 'Property Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('show.property')->with($notification);
    }


    public function DeleteProperty($id)
    {
        PropertyType::findOrFail($id)->delete();
        
        $notification = array(
            'message' => 'Property Deleted Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
