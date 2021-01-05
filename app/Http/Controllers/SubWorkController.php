<?php

namespace App\Http\Controllers;

use App\Model\SubWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function React\Promise\all;

class SubWorkController extends Controller
{
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

        $id = $request->id;
        $workList = SubWork::find($id);
        $data = $request->all();
        $workList->update($data);

        return redirect()->back()->with('message','Work ref_no Created Successfully');
    }
    public  function SubWorkDetails($id){

        $detailswork =  SubWork::find($id);
        return view('admin.work.work_details',compact('detailswork'));
    }
}
