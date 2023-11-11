<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActive extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    protected $table = 'user_actives';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
