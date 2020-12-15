<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'company_name', 'project_name', 'project_ref', 'project_start', 'project_start', 'address', 'status',
    ];
}
