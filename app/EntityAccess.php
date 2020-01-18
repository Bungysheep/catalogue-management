<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntityAccess extends Model
{
    public $incrementing = false;

    public $timestamps = false;

    protected $table = 'entity_access';

    protected $primaryKey = 'entity_key';

    protected $keyType = 'string';

    protected $fillable = [
        'entity_key', 'description', 'default_access'
    ];

    protected $casts = [
        'entity_key' => 'string',
        'default_access' => 'array'
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_access', 'role_code', 'entity_key')
            ->withPivot([
                'override_access'
            ])
            ->as('role_access');
    }
}
