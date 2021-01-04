<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materials';

    protected $fillable=[
        'material_name', 'category', 'unit', 'price', 'details',
    ];
}
