<?php

namespace App\Http\Controllers;

use App\Http\Traits\sendverifyemail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVirefyController extends Controller
{
    use sendverifyemail;


    public function SouldVerify()
    {
        $user = User::find(Auth::user()->id);
        if ($user->verify_status == 'pending') {
            return view('pages.Auth.souldVerify');
        }
        return redirect()->route('Dashboard.index');
    }

    public function EmailVerify(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user->verify_status == "pending") {
            if ($user->hasValidToken()) {
                if ($user->checkToken($request->v)) {
                    $user->verify_status = "verified";
                    $user->email_verified_at = now();
                    $user->save();

                    return redirect()->route('Login.view')->with('success', 'account active and email verified');
                }
                return redirect()->route('Login.view')->with('error', 'erorr in token');
            } else {

                return redirect()->route('Admin.SouldVerify.view')->with('error', 'The token has expired. Resend the email ');
            }
        } else {

            return redirect()->route('Login.view')->with('success', 'account active');
        }
    }

    public function resendVerify()
    {
        $user = User::find(Auth::user()->id);
        $token = bcrypt(time());
        $date = now();
        $new_date = $date->addMinutes(15);
        $user->verify_Token = $token;
        $user->Expiration_verify_Token = $new_date;
        $user->save();

        $mailsubject = env('DigitalRoots') . " email verification";

        $this->send(route('Admin.EmailVerify.post'), $mailsubject, $user->name, $token, $user->email);
        return redirect()->route('Admin.SouldVerify.view')->with('success', 'check your email');
    }
}
