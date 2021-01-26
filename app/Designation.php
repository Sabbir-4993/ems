<?php

namespace App;

use App\Permission;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $guarded=[];

    protected $table = 'designations';
    protected $fillable = [
        'name', 'description',
    ];

    public function permission(){
        return $this->hasOne(Permission::class);
    }

}
