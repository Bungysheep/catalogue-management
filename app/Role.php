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
            ->using('App\RoleUsers')
            ->as('role_users');
    }

    public function allEntityAccess()
    {
        return $this->belongsToMany('App\EntityAccess', 'role_access', 'role_code', 'entity_key')
            ->using('App\RoleAccess')
            ->withPivot([
                'override_access'
            ])
            ->as('role_access');
    }

    public function entityAccess($entityKey)
    {
        return $this->allEntityAccess()->where('entity_access.entity_key', $entityKey);
    }

    public function hasAccess($entityKey, $accessName) : bool
    {
        $entityAccesses = $this->entityAccess($entityKey)->get();

        foreach($entityAccesses as $entityAccess)
        {
            if (is_null($entityAccess->role_access->hasAccessTo($accessName)))
            {
                if ($entityAccess->hasAccessTo($accessName))
                {
                    return true;
                }
            }
            elseif ($entityAccess->role_access->hasAccessTo($accessName))
            {
                return true;
            }
        }

        return false;
    }
}
