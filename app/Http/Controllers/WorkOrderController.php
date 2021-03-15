<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use function React\Promise\all;

class WorkOrderController extends Controller
{
    public function addWorkOrder(Request $request){
        return view('admin.project.work-order');
    }

    public function workOrderStore(Request $request){

        $validator = Validator::make($request->all(), [
            'project_name' => 'required',
            'work_order' => 'required|unique:work_orders',
            'status' => 'required',
            'details' => 'required',
            'created_by' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('message1', ' Work Order Matched ! Check Work Order No.');
        }else{
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
    }


    public function workOrderList(){
        $project = Project::orderBy('id', 'DESC')->get();
        return view('admin.project.work-order-list', compact('project'));
    }

    public function updateWorkOrder(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'project_name' => 'required',
            'work_order' => 'required',
            'status' => 'required',
            'updated_by' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('message1', ' Work Order Matched ! Check Work Order No.');
        }else {
            $data = array();
            $data['project_id'] = $request->project_name;
            $data['work_order'] = $request->work_order;
            $data['status'] = $request->status;
            $data['updated_by'] = $request->updated_by;
            $data['updated_at'] = date('d/m/y');
            DB::table('work_orders')->where('id', $id)->update($data);
            return redirect()->back()->with('message', 'Work Order Updated Successfully');
        }

    }
}
