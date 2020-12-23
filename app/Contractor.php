<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    protected $table = 'contractors';

    protected $fillable = [
        'contractor_name', 'contractor_phone','contractor_details', 'contractor_address','assign_by',
    ];
}
