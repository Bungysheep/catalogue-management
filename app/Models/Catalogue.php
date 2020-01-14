<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
    protected $primaryKey = 'catalogue_code';

    protected $keyType = 'string';

    protected $fillable = [
        'catalogue_code', 'description', 'details', 'status'
    ];
}
