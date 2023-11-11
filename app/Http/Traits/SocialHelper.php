<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

trait SocialHelper
{

    public function haspassword($social_type, $userpassword): bool
    {
        if (!($social_type == "google" && Hash::check('my-google', $userpassword))) {
            return true;
        } else {
            return false;
        }
    }
}
