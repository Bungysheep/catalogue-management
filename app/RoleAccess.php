<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleAccess extends Model
{
    public $incrementing = false;

    public $timestamps = false;

    protected $table = 'role_access';

    protected $fillable = [
        'role_code', 'entity_key', 'override_access'
    ];

    protected $casts = [
        'role_code' => 'string',
        'entity_key' => 'string',
        'override_access' => 'array'
    ];
}
