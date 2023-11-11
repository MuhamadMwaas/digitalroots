<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginValidate;
use App\Http\Requests\RegistrationValidate;
use App\Http\Traits\sendverifyemail;
use App\Mail\sendVerifeictionEmail;
use App\Mail\sendVerifeictionEmails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\MessageBag;
use Spatie\Permission\Models\Role;

class AdminAuthController extends Controller
{
    use sendverifyemail;
    public function LoginView()
    {
        return view('pages.Auth.Sign_in');
    }

    public function LoginPost(LoginValidate $request)
    {

        //get email and password
        $credentials = $request->only('email', 'password');
        if (auth()->guard('web')->attempt($credentials)) {
            $admin = User::where('email', '=', $request->email)->first();
            Auth::login($admin);
            $response = redirect()->route('Dashboard.index');

            $request->session()->regenerate();
            return $response;
        } else {
            $errors = new MessageBag();
            $errors->add('error_in_login', 'credentials not correct');
            return back()->withErrors($errors);
        }
    }

    public function Logout(Request $request)
    {
        auth()->guard('web')->logout();
        $request->session()->flush();
        return redirect()->route('Login.view');
    }

    public function RegisterView()
    {
        return view('pages.Auth.Sign_up');
    }

    public function RegisterPost(RegistrationValidate $request)
    {

        //genrate encrpt token
        $token = bcrypt(time());
        $date = now();
        //expiration date of token
        $new_date = $date->addMinutes(15);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'verify_Token' => $token,
            'Expiration_verify_Token' => $new_date,
            'password' => bcrypt($request->password)
        ]);


        if ($user) {
            $role = Role::Where('name', '=', 'user')->first();
            $user->assignRole([$role->id]);

            $verificationUrl = route('Admin.EmailVerify.post');
            $mailsubject = env('DigitalRoots') . " email verification";
            //send verify form to email
            $this->send($verificationUrl, $mailsubject, $user->name, $token, $user->email);

            // Mail::to($request->email)->send(new sendVerifeictionEmail($mailsubject, $UserData));
            Auth::login($user);
            return redirect()->route('Admin.SouldVerify.view')->with('success', 'check your email');
        }
        return redirect()->route('Login.view')->with('error', 'erro in registration account');
    }
}
