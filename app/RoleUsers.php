<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleUsers extends Pivot
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
