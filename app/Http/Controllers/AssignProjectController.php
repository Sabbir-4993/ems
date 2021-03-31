<?php

namespace App\Http\Controllers;

use App\Category;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Null_;

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
            'work_order' => 'required|unique:assingproject',
            'total_payable' => 'required',
        ]);
        $data = array();
        $data['contractor_id'] = $request->contractor_name;
        $data['project_id'] = $request->project_name;
        $data['project_work_order'] = $request->project_work_order;
        $data['category_id'] = $request->category_name;
        $data['assign_date'] = $request->assign_date;
        $data['end_date'] = $request->end_date;
        $data['work_order'] = $request->work_order;
        $data['total_payable'] = $request->total_payable;
        DB::table('assingproject')->insert($data);
        return redirect()->route('assignProject.view')->with('message', 'Project Assign Successfully');
    }
    public function viewProject(){
        $assignProjectDetails =DB::table('assingproject')->orderBy('id', 'DESC')->get();
        return view('admin.contractor.assignProjectList',compact('assignProjectDetails'));
    }
    public function viewProjectDetails($id){
        $projects = DB::table('assingproject')->where('id',$id)->orderBy('id', 'DESC')->get();

        return view('admin.contractor.assignProjectDetails',compact('projects'));
    }
    public function projectBillPay(Request $request){

        $validator = Validator::make($request->all(), [
//            'billing_no' => 'required|unique:billing_histories',
            'pay_amount' => 'required',
        ]);
        $Bill_has = DB::table('billing_histories')->where('project_id',$request->project_id)->get();
        $projectName = Project::where('id',$request->project_id)->first();

        if($validator->fails()) {
            return redirect()->back()->with('message1', ' Bill Number Matched ! Check Bill No.');
        }else{
            $data = array();
            $data['project_id'] = $request->project_id;
            $data['contractor_id'] = $request->contractor_id;
            $data['project_work_no'] = $request->project_work_no;
            $data['work_order'] = $request->work_id;
            if ($Bill_has ==null){
                $data['billing_no'] = $projectName->project_name.'-'.'1';
            }else{
                $bill_no  =count($Bill_has);
                $data['billing_no'] = $projectName->project_name.'-'.($bill_no+1);
            }
            $data['billing_amount'] = $request->pay_amount;
            $data['billing_method'] = $request->billing_method;
            $data['billing_details'] = $request->billing_details;
            $data['billing_date'] = $request->billing_date;
            $billData = DB::table('assingproject')->where('work_order',$request->work_id)->orderBy('id', 'DESC')->get();
            foreach ($billData as $bill){
                if ($bill->total_pay == null){
                    DB::table('billing_histories')->insert($data);
                    DB::table('assingproject')->where('work_order',$request->work_id)
                        ->update([
                            'total_due'=>DB::raw('total_payable -'.$request->pay_amount),
                            'total_pay'=>$request->pay_amount
                        ]);
                    return redirect()->back()->with('message', 'Contractor Bill Paid Successfully');

                }
                elseif ($bill->total_payable == $bill->total_pay){
                    return redirect()->back()->with('message', ' No Bill Due !...All Bill Paid ');

                }
                elseif ($bill->total_due < $request->pay_amount){
                    return redirect()->back()->with('message2', ' Bill Amount Check ! You Are Paying Extra Bill');
                }
                else{

                    DB::table('billing_histories')->insert($data);
                    DB::table('assingproject')->where('work_order',$request->work_id)
                        ->update([
                            'total_pay'=>DB::raw('total_pay +'.$request->pay_amount),
                            'total_due'=>DB::raw('total_payable -'.'total_pay'),
                        ]);
                    return redirect()->back()->with('message', 'Contractor Bill Paid Successfully');

                }
            }


        }
    }

}
