<?php

namespace App;

use App\Permission;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use function Symfony\Component\Translation\t;
use App\Designation;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'name', 'email', 'password', 'mobile_number', 'address', 'image', 'skill',
        'blood_group', 'marital_status', 'department_id', 'designation', 'join_date',
        'salary', 'loan', 'emp_type', 'emp_status', 'edu', 'edu_year', 'pre_work',
        'pre_work_year',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function designation(){
        return $this->hasOne(Designation::class, 'designation', 'designation_id');
    }

    public function permission(){
        return $this->hasOne(Permission::class);
    }
}
