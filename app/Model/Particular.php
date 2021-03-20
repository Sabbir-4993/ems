<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Particular extends Model
{
    protected $table = 'particulars';

    protected $fillable = [
        'particular',
        'quantity',
        'remarks',
    ];
}
