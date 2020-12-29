<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RequisitionController extends Controller
{
    public function index(){
        return view('admin.requisition.create');
    }
    public function storeRequisition( Request  $request){

        $validator = Validator::make($request->all(), [
            'project_id'=>'required',
            'requisition_no'=>'required',
            'particular'=>'required',
            'quantity'=>'required',
            'unit'=>'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('message1', 'Check Input Data !');
        }
        else{
            $requisition = array();
            $requisition['user_id'] = Auth()->id();
            $requisition['project_id'] = $request->project_id;
            $requisition['status'] = 0;
            $requisition['req_no'] = $request->requisition_no;
            $requisition['requisition_date'] = date('d/m/y');
            $requisitionId = DB::table('requisitions')->insertGetId($requisition);
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
            return redirect()->back()->with('message', 'Requisition Submitted Successfully');
        }


    }

    public function pendingRequisition(){
        $pendingRequisitions = DB::table('requisitions')
            ->where('requisitions.status', '0')
            ->get();
        return view('admin.requisition.pending_requisition',compact('pendingRequisitions'));
    }
    public function detailsRequisition($id){

        $detailsRequisitions = DB::table('requisitions')
            ->join('requisition_details','requisition_details.requisition_id','=','requisitions.id')
            ->where('requisitions.id', $id)
            ->select('requisition_details.*','requisitions.*')
            ->get();
        return view('admin.requisition.details_requisitions',compact('detailsRequisitions'));
    }
    public function approveRequisition(Request $request ){

        $requisition = array();
        $requisition['updated_by'] = Auth()->id();
        $requisition['status'] = '1';
//        DB::table('requisitions')->where('requisitions.id', $request->id)->update($requisition);

        $a = DB::table('requisition_details')->where('requisition_id',$request->id)->get();
        foreach ($a as $b){
                dd($b);
            }



//        $count = count($request->price);
//        for ($i=0; $i < $count; $i++) {
//            $task =  array();
//            $task['unit_price'] = $request->price[$i];
//            $task['pro_remarks'] = $request->pro_remarks[$i];
//            $task['total_price'] = $request->total[$i];
//            DB::table('requisition_details')->where('requisition_id',$request->id)->update($task);
//        }

//        return redirect()->route('requisition.pending')->with('message', 'Requisition Approved Successfully');

    }
    public function completeRequisition(){
        $approvedRequisitions = DB::table('requisitions')
            ->where('requisitions.status', '1')
            ->get();
        return view('admin.requisition.approved_requisition',compact('approvedRequisitions'));
    }
    public function approvedDetailsRequisition($id){
        $approvedDetailsRequisitions = DB::table('requisitions')
            ->join('requisition_details','requisition_details.requisition_id','=','requisitions.id')
            ->where('requisitions.id', $id)
            ->select('requisition_details.*','requisitions.*')
            ->get();
        return view('admin.requisition.approved_details_requisitions',compact('approvedDetailsRequisitions'));
    }
}
