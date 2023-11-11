<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Http\Traits\EmailFerify;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, EmailFerify, HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'social_type',
        'social_id',
        'Expiration_verify_Token',
        'verify_Token',
        'verify_status',
        'google2fa_secret',
        'google2fa_enable'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function setGoogle2fasecret($value)
    {
        $this->attributes['google2fa_enable'] = encrypt($value);
    }

    public function getGoogle2fasecret()
    {
        return decrypt($this->attributes['google2fa_enable']);
    }

    public static function getusers()
    {
        $users = self::where('is_super', 0)->get();
        return $users;
    }


    public function lastseen()
    {
        return UserActive::where('user_id', '=', $this->id)->first();
    }
}
