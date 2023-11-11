<?php

namespace App\Http\Traits;

use App\Mail\sendVerifeictionEmail;
use App\Mail\sendVerifeictionEmails;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

trait sendverifyemail
{

    public function send($url, $mailsubject, $name, $token, $email)
    {
        $mailsubject = $mailsubject;
        $UserData = [
            'name'  => $name,
            'email' =>  $email,
            'token' => $token,
            'url'   =>  $url
        ];
        // Mail::to($email)->send(new sendVerifeictionEmails($mailsubject, $UserData));

        Mail::to($email)->send(new sendVerifeictionEmail($mailsubject, $UserData));
    }
}
