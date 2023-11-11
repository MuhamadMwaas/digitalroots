<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\SocialHelper;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Mockery\Expectation;
use Spatie\Permission\Models\Role;

class SocialAuthController extends Controller
{
    use SocialHelper;
    public function redirectToGoogel()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handelGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $iflogedin = User::where('social_id', $user->id)->first();
            if ($iflogedin) {
                Auth::login($iflogedin);
                return redirect()->route('Dashboard.index');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id' => $user->id,
                    'social_type' => 'google',
                    'verify_status' => 'verified',
                    'password' => bcrypt('my-google')
                ]);
                $role = Role::Where('name', '=', 'user')->first();
                // get user from model instans from assign role for it
                $muser = User::find($newUser->id);
                $muser->assignRole([$role->id]);
                Auth::login($newUser);
                return redirect()->route('Dashboard.index');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function newpassword()
    {
        if (!$this->haspassword(Auth::user()->social_type, Auth::user()->password)) {
            return view('pages.Auth.new_password');
        } else {
            return redirect()->route('Dashboard.index');
        }
    }

    public function newpasswordPost(Request $request)
    {
        $request->validate(['password' => 'required|confirmed']);
        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('Dashboard.index')->with('success', 'The password updated');
    }
}
