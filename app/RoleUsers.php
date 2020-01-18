<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUsers extends Model
{
    public $incrementing = false;

    public $timestamps = false;

    protected $table = 'role_users';

    protected $fillable = [
        'user_id', 'role_code'
    ];

    protected $casts = [
        //
    ];
}
