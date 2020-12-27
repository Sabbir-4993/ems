<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequisitionController extends Controller
{
    public function index(){
        return view('admin.requisition.create');
    }
    public function storeRequisition( Request  $request){
        $this->validate($request,[
            'project_id'=>'required',
            'particular'=>'required',
            'quantity'=>'required',
            'unit'=>'required',
            'remarks'=>'required',
        ]);

//        Requisition Table
        $requisitions = DB::table('requisitions')->where('project_id', $request->project_id)
            ->orderBy('project_id', 'desc')->latest('id')->first();
        if ($requisitions == null){
            $requisition = array();
            $requisition['user_id'] = Auth()->id();
            $requisition['project_id'] = $request->project_id;
            $requisition['status'] = '0';
            $requisition['req_no'] = $request->requisition_no;
            $requisitionId = DB::table('requisitions')->insertGetId($requisition);
        }
        else{
            $requisition = array();
            $requisition['user_id'] = Auth()->id();
            $requisition['project_id'] = $request->project_id;
            $requisition['status'] = 0;
            $requisition['req_no'] = $request->requisition_no;
            $requisitionId = DB::table('requisitions')->insertGetId($requisition);
        }

//        Requisition details Table
        $count = count($request->particular)-1;
        for ($i=0; $i < $count; $i++) {
            $task =  array();
            $task['requisition_id'] = $requisitionId;
            $task['particular'] = $request->particular[$i];
            $task['quantity'] = $request->quantity[$i];
            $task['unit'] = $request->unit[$i];
            $task['remarks'] = $request->remarks[$i];
            DB::table('requisition_details')->insert($task);
        }
        return redirect()->back()->with('message', 'Requisition Created Successfully');

    }
}
