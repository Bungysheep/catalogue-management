<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $incrementing = false;

    protected $table = 'roles';

    protected $primaryKey = 'role_code';

    protected $keyType = 'string';

    protected $fillable = [
        'role_code', 'description', 'details', 'status'
    ];

    protected $casts = [
        'role_code' => 'string'
    ];
}
