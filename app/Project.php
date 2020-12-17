<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'project_name',
        'company_name',
        'company_email',
        'project_ref',
        'project_start',
        'project_end',
        'phone',
        'address',
        'status',
    ];
}
