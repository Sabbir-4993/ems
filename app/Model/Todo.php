<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todos';

    protected $fillable = [
        'employee_id',
        'work_title',
        'work_description',
        'added_date',
        'status',
    ];
}
