<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FAQRCode\Google2FA;
use Illuminate\Support\Facades\Crypt;

class Google2FAController extends Controller
{
    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function enableTwoFactor(Request $request)
    {

        //get user
        $user = $request->user();

        $google2fa = app('pragmarx.google2fa');
        //genrate secret key
        if (session("2fa_secret")) {
            $secret = session("2fa_secret");
        } else {
            $secret = $google2fa->generateSecretKey();
        }

        // $user->google2fa_secret = encrypt($secret);
        // $user->save();

        //generate image for QR barcode
        $qr_code = $google2fa->getQRCodeInline(
            "DigitalRoots",
            $user->email,
            $secret,
            200
        );
        session(["2fa_secret" => $secret]);

        return view('pages.2FA.2fa_set', [
            'secret' => $secret,
            "qr_code" => $qr_code,

        ]);
    }


    /**
     * check the submitted OTP
     * if correct, enable 2FA
     */
    public function twofaEnable(Request $request)
    {
        $google2fa = app('pragmarx.google2fa');

        // retrieve secret from the session
        $secret = session("2fa_secret");
        $user = User::find(Auth::user()->id);

        if ($google2fa->verifyKey($secret, $request->otp)) {



            $user->google2fa_secret = encrypt($secret);
            $user->save();

            // avoid double OTP check
            session(["2fa_checked" => true]);

            return redirect()->route('Dashboard.index');
        }

        throw ValidationException::withMessages([
            'otp' => 'Incorrect value. Please try again...'
        ]);
    }


    public function show()
    {
        return view('auth.otp');
    }

    public function check(Request $request)
    {
        $google2fa = new Google2FA();
        $secret = Auth::user()->google2fa_secret;
        if ($google2fa->verify($request->otp, $request->sec)) {
            session(["2fa_checked" => true]);
            return redirect("/");
        }

        throw ValidationException::withMessages([
            'otp' => 'Incorrect value. Please try again...'
        ]);
    }


    public function showotp()
    {
        return view('pages.2FA.otp_show');
    }

    public function checkotp(Request $request)
    {
        $google2fa = new Google2FA();
        $secret = decrypt(Auth::user()->google2fa_secret);
        if ($google2fa->verify($request->input('one_time_password'), $secret)) {
            session(["2fa_checked" => true]);
            return redirect()->route('Dashboard.index');
        }

        throw ValidationException::withMessages([
            'otp' => 'Incorrect value. Please try again...'
        ]);
    }
}
