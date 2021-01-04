<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'vendor_name',
        'vendor_phone',
        'vendor_address',
        'assign_by',
        'vendor_details',
        'created_by',
    ];
}
