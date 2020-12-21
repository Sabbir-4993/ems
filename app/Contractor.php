<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    protected $table = 'contractors';

    protected $fillable = [
        'contractor_name', 'contractor_type','project_id', 'assign_date', 'end_date','total_payable', 'assign_by',
    ];
}
