<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    protected $table = 'requisitions';

    protected $fillable = [
        'user_id', 'project_id', 'status', 'req_no', 'requisition_date'
        ];
}
