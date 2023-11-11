<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;


trait EmailFerify
{

    public function vaildTime(): bool
    {
        $date = Date::createFromFormat("Y-m-d H:i:s", $this->Expiration_verify_Token);
        if (now() <= $date) {
            return true;
        }

        return false;
    }

    public function hasValidToken(): bool
    {
        if ($this->verify_status == "pending" && $this->vaildTime()) {
            return true;
        }
        return false;
    }

    public function checkToken($token)
    {
        if ($this->verify_Token == $token) {
            return true;
        }
        return false;
    }
}
