<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable=[
        'material_name', 'category', 'unit', 'price', 'details',
    ];
}
