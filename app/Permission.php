<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Designation;
use App\User;

class Permission extends Model
{
    protected $guarded=[];

    protected $casts = [
        'name' => 'array',
    ];

    public function designation(){
        return $this->belongsTo(Designation::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
