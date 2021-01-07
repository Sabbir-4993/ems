<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use function React\Promise\all;

class WorkOrderController extends Controller
{
    public function addWorkOrder(Request $request){
        return view('admin.project.work-order');
    }

    public function workOrderStore(Request $request){

        $this->validate($request,[
            'project_name' => 'required',
            'work_order' => 'required',
            'status' => 'required',
            'details' => 'required',
            'created_by' => 'required',
        ]);
        $data = array();
        $data['project_id'] = $request->project_name;
        $data['work_order'] = $request->work_order;
        $data['status'] = $request->status;
        $data['details'] = $request->details;
        $data['created_by'] = $request->created_by;
        $data['created_date'] = date('d/m/y');
        DB::table('work_orders')->insert($data);
        return redirect()->route('workOrder.list')->with('message', 'Work Order Created Successfully');
    }


    public function workOrderList(){
        $project = Project::orderBy('id', 'DESC')->get();
        return view('admin.project.work-order-list', compact('project'));
    }
}
