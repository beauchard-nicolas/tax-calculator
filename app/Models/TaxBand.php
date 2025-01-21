<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxBand extends Model
{
    protected $fillable = [
        'name',
        'lower_limit',
        'upper_limit',
        'rate'
    ];

    protected $casts = [
        'lower_limit' => 'integer',
        'upper_limit' => 'integer',
        'rate' => 'integer',
    ];
} 