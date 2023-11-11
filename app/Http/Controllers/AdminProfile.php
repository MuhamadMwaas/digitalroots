<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminProfile extends Controller
{
    use ImageHelper;

    public function ProfileShow()
    {

        $admin = Auth::user();
        return view('Dashboard.profile', compact('admin'));
    }

    public function RemoveImage(Request $request)
    {
        $admin = User::find(Auth::user()->id);
        $this->deleteImage('images/Admins/' . $admin->id . '/' . $admin->image);
        //remove image name from admin database record
        $admin->image = null;
        $admin->save();


        $data = [
            'message' => 'image Removed',
            'status' => 'done'
        ];
        //api return
        return response()->json($data, 200);
    }

    public function UpdateProfile(Request $request)
    {
        $admin = User::find(Auth::user()->id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::user()->email . ',email',
            'password' => 'confirmed',
            'current_Password' => 'required'
        ]);

        //if admin enter rong password
        if (!Hash::check($request->current_Password, $admin->password)) {
            return redirect()->route('Admin.profile')->with('error', 'error in password');
        }

        //if admin want to change current password
        if ($request->password) {
            if ($request->password == $request->password_confirmation) {
                $admin->password = bcrypt($request->password);
            } else {
                return redirect()->route('Admin.profile')->with('error', 'The passwords do not match');
            }
        }
        $Imagename = null;

        //when user change his image
        if ($request->hasFile('image')) {

            //if admin has image delete old image
            if ($admin->image != null) {
                $this->deleteImage('images/Admins/' . $admin->id . '/' . $admin->image);
            }

            $Imagename = $this->storeImage($request->image, 'images/Admins/' . $admin->id);
        }
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->image =  $Imagename;
        $admin->save();

        return redirect()->route('Admin.profile')->with('success', 'profile data update');
    }
}
