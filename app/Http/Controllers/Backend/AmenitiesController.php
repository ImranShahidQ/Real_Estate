<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AmenitiesController extends Controller
{
    public function ShowAmenitie()
    {
        $amenitie = Amenities::latest()->get();
        return view('admin.amenitie.show_amenitie',compact('amenitie'));
    }


    public function AddAmenitie()
    {
        return view('admin.amenitie.add_amenitie');
    }


    public function StoreAmenitie(Request $request)
    {
        Amenities::insert([
            'amenities_name' => $request->amenities_name,
        ]);
        $notification = array(
            'message' => 'Amenities Added Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('show.amenitie')->with($notification);
    }


    public function EditAmenitie($id)
    {
        $amenitie = Amenities::findOrFail($id);
        return view('admin.amenitie.edit_amenitie',compact('amenitie'));
    }


    public function UpdateAmenitie(Request $request)
    {
        $aid = $request->id;
        Amenities::findOrFail($aid)->update([
            'amenities_name' => $request->amenities_name,
        ]);
        $notification = array(
            'message' => 'Amenities Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('show.amenitie')->with($notification);
    }


    public function DeleteAmenitie($id)
    {
        Amenities::findOrFail($id)->delete();
        
        $notification = array(
            'message' => 'Amenities Deleted Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
