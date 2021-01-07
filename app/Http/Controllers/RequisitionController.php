<?php

namespace App\Http\Controllers;

use App\Material;
use App\Model\SubWork;
use App\User;
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
            $count = count($request->quantity)-1;
            for ($i=0; $i < $count; $i++) {
                $task =  array();
                $task['requisition_id'] = $requisitionId;
                $task['particular'] = $request->particular[$i];
                $task['quantity'] = $request->quantity[$i];
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

        $validator = Validator::make($request->all(), [
            'total'=>'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('message1', 'Check Input Data !');
        }
        else {
            $requisition = array();
            $requisition['updated_by'] = Auth()->id();
            $requisition['status'] = '1';
            $requisition['approved_date'] = date('d/m/y');
            DB::table('requisitions')->where('id',$request->id)->update($requisition);
            $count = count($request->total);
            for ($i = 0; $i < $count; $i++) {
                $approvedTask = array();
                $approvedTask['requisition_id'] = $request->id;
                $approvedTask['particular'] = $request->particular[$i];
                $approvedTask['quantity'] = $request->quantity[$i];
                $approvedTask['unit'] = $request->unit[$i];
                $approvedTask['unit_price'] = $request->price[$i];
                $approvedTask['total_price'] = $request->total[$i];
                $approvedTask['pro_remarks'] = $request->remarks[$i];
                DB::table('approved_requisition_details')->insert($approvedTask);
            }
            return redirect()->route('requisition.complete')->with('message', 'Requisition Approved Successfully');

        }
    }
    public function completeRequisition(){
        $approvedRequisitions = DB::table('requisitions')
            ->where('requisitions.status', '1')
            ->get();
        return view('admin.requisition.approved_requisition',compact('approvedRequisitions'));
    }
    public function approvedDetailsRequisition($id){
        $approvedDetailsRequisitions = DB::table('requisitions')
            ->join('approved_requisition_details','approved_requisition_details.requisition_id','=','requisitions.id')
            ->where('requisitions.id', $id)
            ->select('approved_requisition_details.*','requisitions.*')
            ->get();
        return view('admin.requisition.approved_details_requisitions',compact('approvedDetailsRequisitions'));
    }
    public function printRequisition($id){
        $approvedDetailsRequisitions = DB::table('requisitions')
            ->join('approved_requisition_details','approved_requisition_details.requisition_id','=','requisitions.id')
            ->where('requisitions.id', $id)
            ->select('approved_requisition_details.*','requisitions.*')
            ->get();
        return view('admin.requisition.print_requisitions',compact('approvedDetailsRequisitions'));
    }

    public function getWorkNo(Request $request){

        $parent_id = $request->cat_id;
        $subcategories = SubWork::where('project_id',$parent_id)
            ->select('subWork_name','id')
            ->get();
        return response()->json($subcategories);
    }

}
