<?php

namespace App\Http\Controllers;

use App\Category;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignProjectController extends Controller
{
    public function index(){
        return view('admin.contractor.assignProject');
    }
    public function storeProject( Request  $request){

        $request->validate([
            'contractor_name' => 'required',
            'project_name' => 'required',
            'category_name' => 'required',
            'assign_date' => 'required',
            'end_date' => 'required',
            'work_order' => 'required',
            'total_payable' => 'required',
        ]);
        $data = array();
        $data['contractor_id'] = $request->contractor_name;
        $data['project_id'] = $request->project_name;
        $data['category_id'] = $request->category_name;
        $data['assign_date'] = $request->assign_date;
        $data['end_date'] = $request->end_date;
        $data['work_order'] = $request->work_order;
        $data['total_payable'] = $request->total_payable;
        DB::table('assingproject')->insert($data);
        return redirect()->back();
    }
}
