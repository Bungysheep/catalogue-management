<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleAccess extends Pivot
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

    public function hasAccessTo($accessName)
    {
        if (array_key_exists($accessName, $this->override_access))
        {
            return $this->override_access[$accessName];
        }

        return null;
    }
}
