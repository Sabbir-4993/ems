<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssignWorkController extends Controller
{
    public function index(){
        return view('admin.todo.create');
    }

//    public function storeWork( Request  $request){

//        $request->validate([
//            'contractor_name' => 'required',
//            'project_name' => 'required',
//            'category_name' => 'required',
//            'assign_date' => 'required',
//            'end_date' => 'required',
//            'work_order' => 'required|unique:assingproject',
//            'total_payable' => 'required',
//        ]);
//    }

}
