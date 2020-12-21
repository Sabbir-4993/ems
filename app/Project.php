<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'project_name',
        'company_name',
        'description',
        'project_ref',
        'company_email',
        'address',
        'phone',
        'project_leader',
        'status',
        'est_budget',
        'total_amount',
        'pro_duration',
        'project_start',
        'project_end',
    ];
}
