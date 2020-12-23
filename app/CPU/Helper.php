<?php


namespace App\CPU;


use Illuminate\Support\Facades\DB;

class Helper
{
    public static function projectList($id){
        $project = DB::table('projects')->where('id',$id)->first();
        return $project;
    }
}
