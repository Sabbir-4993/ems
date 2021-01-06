<?php

namespace App\Http\Controllers;

use App\Model\SubWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Array_;
use function React\Promise\all;

class SubWorkController extends Controller
{
    public  function SubWorkDetails($id){

        $detailswork =  SubWork::find($id);
        return view('admin.work.work_details',compact('detailswork'));
    }
    public  function storeSubWork(Request $request){

        $input = $request->all();
        $employee = $input['employee_id'];
        $input['assign_employee'] = implode(',', $employee);
        $input['subWork_name'] = $request->work_name;
        $input['subWork_start'] = $request->work_start;
        $input['subWork_end'] = $request->work_end;
        $input['created_by'] = Auth()->id();
        SubWork::create($input);
        return redirect()->back()->with('message','Work Created Successfully');
    }
    public  function storeSubWorkRefNo(Request $request){


        $validator = Validator::make($request->all(), [
            'ref_no' => 'required|unique:sub_works',
        ]);
        if($validator->fails()) {
            return redirect()->back()->with('message1', 'Work ref_no Match');
        }else {
            $id = $request->id;
            $workList = SubWork::find($id);
            if ($workList->ref_no == null){
                $data = $request->all();
                $workList->update($data);
                return redirect()->back()->with('message', 'Work ref_no Created Successfully');
            }else{
                return redirect()->back()->with('message1', 'Work Ref_No Already Have');
            }

        }
    }
    public  function storeRemarks(Request $request){

        $validator = Validator::make($request->all(), [
            'remarks' => 'required',
        ]);
        if($validator->fails()) {
            return redirect()->back()->with('message1', 'Remarks Required');
        }else {
            $id = $request->id;
            $workLists = SubWork::find($id);
            if ($workLists->remarks == null){
                $data = $request->all();
                $workLists->update($data);
                return redirect()->back()->with('message', 'Work Delay Remarks Added Successfully');
            }else{
                return redirect()->back()->with('message1', 'Work Delay Remarks Already Have');
            }
        }
    }
    public  function storeParticulars(Request $request){

            $prticulars = Array();
            $prticulars['subWork_id']= $request->id;
            $prticulars['work_name']= $request->particular_name;
            $prticulars['work_details']= $request->particular_details;
            DB::table('sub_work_details')->insert($prticulars);
            return redirect()->back()->with('message', 'Work Particulars Added Successfully');
    }

    public  function storeParticularsDelete($id){

            DB::table('sub_work_details')->where('id',$id)->delete();
            return redirect()->back()->with('message', 'Work Particulars Delete Successfully');
    }


}
