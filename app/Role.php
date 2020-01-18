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

    public function users()
    {
        return $this->belongsToMany('App\Role', 'role_users', 'user_id', 'role_code')
            ->as('role_users');
    }

    public function entityAccess()
    {
        return $this->belongsToMany('App\EntityAccess', 'role_access', 'role_code', 'entity_key')
            ->withPivot([
                'override_access'
            ])
            ->as('role_access');
    }
}
