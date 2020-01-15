<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
    public $incrementing = false;

    protected $table = 'catalogues';

    protected $primaryKey = 'catalogue_code';

    protected $keyType = 'string';

    protected $fillable = [
        'catalogue_code', 'description', 'details', 'status'
    ];

    protected $casts = [
        'catalogue_code' => 'string'
    ];
}
