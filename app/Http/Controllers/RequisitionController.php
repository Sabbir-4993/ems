<?php

namespace App\Http\Controllers;

use App\Material;
use App\Model\Particular;
use App\Project;
use App\Requisition;
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

        $project = Project::where('id',$request->project_id)->first();
        $workorder = DB::table('work_orders')->where('id',$request->work_order)->first();
        $requisition_no = $project->project_name.'-'.$workorder->work_order;
        $Req_has = Requisition::where('req_no',$requisition_no)->get();

        $validator = Validator::make($request->all(), [
            'work_order'=>'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('message1', 'Check Input Data !');
        }

        else{
            $requisition = array();
            $requisition['created_by'] = Auth()->id();
            $requisition['project_id'] = $request->project_id;
            $requisition['requisition_by'] = $request->requisition_by;
            $requisition['work_order'] = $request->work_order;
            $requisition['status'] = 0;
            if ($Req_has ==null){
                $requisition['req_no'] = $requisition_no.'-'.'1';
            }else{
                $workorder = Requisition::where('work_order',$request->work_order)->get();
                $req_no  =count($workorder);
                $requisition['req_no'] = $requisition_no.'-'.($req_no+1);
            }

            $requisition['requisition_date'] = date('d/m/y');
            $requisitionId = DB::table('requisitions')->insertGetId($requisition);
            $count = count($request->quantity);
            for ($i=0; $i < $count; $i++) {
                $task =  array();
                $task['requisition_id'] = $requisitionId;
                $task['particular'] = $request->particular[$i];
                $task['quantity'] = $request->quantity[$i];
                $task['unit'] = $request->unit[$i];
                $task['remarks'] = $request->remarks[$i];
                DB::table('requisition_details')->insert($task);
            }
            DB::table('particulars')->delete();
            return redirect()->back()->with('message', 'Requisition Submitted Successfully');
        }


    }
    public function pendingRequisition(){
        $pendingRequisitions = DB::table('requisitions')
            ->where('requisitions.status', '0')
            ->orderBy('id', 'DESC')
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
            'price'=>'required',
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
            $count = count($request->price);
            for ($i = 0; $i < $count; $i++) {
                $approvedTask = array();
                $approvedTask['requisition_id'] = $request->id;
                $approvedTask['particular'] = $request->particular[$i];
                $approvedTask['quantity'] = $request->quantity[$i];
                $approvedTask['unit'] = $request->unit[$i];
                $approvedTask['unit_price'] = $request->price[$i];
                $approvedTask['total_price'] = $request->quantity[$i]*$request->price[$i];
                $approvedTask['pro_remarks'] = $request->pro_remarks[$i];
                DB::table('approved_requisition_details')->insert($approvedTask);
            }
            return redirect()->route('requisition.complete')->with('message', 'Requisition Approved Successfully');

        }
    }
    public function completeRequisition(){
        $approvedRequisitions = DB::table('requisitions')
            ->where('requisitions.status', '1')
            ->orderBy('id', 'DESC')
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

        $id = $request->project_id;
        $work_orders = DB::table('work_orders')->where('project_id',$id)
            ->select('work_order','id')
            ->get();
        return response()->json($work_orders);
    }

    public function getMaterial(Request $request){
        $id = $request->cat_id;
        $materials = DB::table('materials')->where('category',$id)
            ->select('material_name','id')
            ->get();
        return response()->json($materials);
    }

}
