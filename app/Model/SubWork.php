<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubWork extends Model
{
    protected $table = 'sub_works';

    protected $fillable = [
        'project_id',
        'subWork_name',
        'assign_employee',
        'subWork_start',
        'subWork_end',
        'ref_no',
        'created_by',
        'remarks',
    ];

}
