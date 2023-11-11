<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;
use Spatie\Permission\Models\Role;

class UserManagement extends Controller
{
    use ImageHelper;


    function __construct()
    {
        $this->middleware('permission:users-list', ['only' => ['list']]);
        $this->middleware('permission:users-edit', ['only' => ['edite', 'update']]);
        $this->middleware('permission:users-delete', ['only' => ['delete']]);
        $this->middleware('permission:users-active-account', ['only' => ['Deactivate', 'active']]);
        $this->middleware('permission:clear2fa', ['only' => ['clear2fa']]);
    }
    const redirect = "Dashboard.index";
    public function list()
    {
        $users = User::getusers();

        return view('pages.Users.Users_list', compact('users'));
    }

    public function show($id)
    {
        $user = User::find($id);
        $image_size = 0;
        if ($user) {
            if ($user->image) {
                $image_size = round(FacadesFile::size('images/Admins/' . $user->id . '/' . $user->image) / 1024, 2);
            }

            return view('pages.Users.User_show', compact('user', 'image_size'));
        } else {
            return redirect()->route(self::redirect)->with('error', 'user not found');
        }
    }

    public function Deactivate(Request $request)
    {

        $user = User::find($request->id);
        if ($user) {
            $user->is_active = false;
            $user->save();

            return redirect()->route('Admin.User.show', $request->id)->with('success', 'The account has been deactivated');
        }
    }
    public function active(Request $request)
    {

        $user = User::find($request->id);
        if ($user) {
            $user->is_active = true;
            $user->save();

            return redirect()->route('Admin.User.show', $request->id)->with('success', 'The account has been activated');
        } else {
            return redirect()->route(self::redirect)->with('error', 'user not found');
        }
    }

    public function delete(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            if ($user->image != null) {
                $this->deleteImage('images/Admins/' . $user->id . '/' . $user->image);
            }
            $user->delete();

            return redirect()->route('Admin.Users.list')->with('success', 'user ' . $user->name . " has been deleted");
        }
    }

    public function edite($id)
    {
        $user = User::find($id);
        if ($user) {
            $roles = Role::pluck('name', 'name')->all();
            $userRole = $user->roles->pluck('name', 'name')->all();
            return view('pages.Users.User_edit', compact('user', 'roles', 'userRole'));
        } else {
            return redirect()->route(self::redirect)->with('error', 'user not found');
        }
    }

    public function update($id, Request $request)
    {
        $user = User::findOrFail($request->id);

        if ($request->password != null) {
            $rules = [
                'name' => 'required|unique:users,name,' . $user->id,
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'required|min:6|confirmed',
                'image.*' => 'nullable|mimes:jpeg,png,jpg,svg,'
            ];
            $this->validate($request, $rules);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
        } else {
            $rules = [
                'name' => 'required|unique:users,name,' . $user->id,
                'email' => 'required|email|unique:users,email,' . $user->id,
                'image.*' => 'nullable|mimes:jpeg,png,jpg,svg,'
            ];

            $this->validate($request, $rules);

            $user->name = $request->name;
            $user->email = $request->email;
        }


        //check if imge edited
        if ($request->new_Image == 't') {
            $Imagename = null;
            //if user has image
            if ($user->image != null) {
                $this->deleteImage('images/Admins/' . $user->id . '/' . $user->image);
            }
            //if user upload image store it
            if ($request->hasFile('image')) {
                $Imagename = $this->storeImage($request->image, 'images/Admins/' . $user->id);
            }
            $user->image = $Imagename;
        }
        $user->save();

        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        $massage = '[ ' . $user->name . ' ]\'s Data has been updated';
        return redirect()->route('Admin.Users.list')->with('success', $massage);
    }

    public function clear2fa(Request $request)
    {
        $user = User::find($request->id);
        $user->google2fa_secret = null;
        $user->save();
        return redirect()->route('Admin.User.show', $request->id)->with('success', 'the 2fa for user reseted');
    }
}
