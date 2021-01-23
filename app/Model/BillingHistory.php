<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BillingHistory extends Model
{
    protected $table = 'billing_histories';

    protected $fillable = [
        'project_id',
        'contractor_id',
        'project_work_no',
        'billing_no',
        'billing_amount',
        'billing_method',
        'billing_details',
        'billing_date',
    ];

}
