<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VendorAssignProjectController extends Controller
{
    public function index(){
        return view('admin.vendor.bill.assignProject');
    }
    public function storeProject( Request  $request){
        $request->validate([
            'vendor_name' => 'required',
            'project_name' => 'required',
            'category_name' => 'required',
            'assign_date' => 'required',
            'pi_number' => 'required|unique:vendor_assign_projects',
            'total_payable' => 'required',
        ]);
        $data = array();
        $data['vendor_id'] = $request->vendor_name;
        $data['project_id'] = $request->project_name;
        $data['project_work_order'] = $request->project_work_order;
        $data['category_id'] = $request->category_name;
        $data['assign_date'] = $request->assign_date;
        $data['pi_number'] = $request->pi_number;
        $data['total_payable'] = $request->total_payable;
        DB::table('vendor_assign_projects')->insert($data);
        return redirect()->route('vendorAssignProject.view')->with('message', 'Project Assign Successfully');
    }
    public function viewProject(){
        $assignProjectDetails =DB::table('vendor_assign_projects')->orderBy('id', 'DESC')->get();
        return view('admin.vendor.bill.assignProjectList')->with(compact('assignProjectDetails'));
    }
    public function viewProjectDetails($id){
        $projects = DB::table('vendor_assign_projects')->where('id',$id)->orderBy('id', 'DESC')->get();

        return view('admin.vendor.bill.assignProjectDetails',compact('projects'));
    }

    public function projectBillPay(Request $request){

        $validator = Validator::make($request->all(), [
            'billing_no' => 'required|unique:vendor_billing_histories',
            'pay_amount' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('message1', ' Bill Number Matched ! Check Bill No.');
        }else{
            $data = array();
            $data['project_id'] = $request->project_id;
            $data['vendor_id'] = $request->vendor_id;
            $data['project_work_no'] = $request->project_work_no;
            $data['pi_number'] = $request->pi_number;
            $data['billing_no'] = $request->billing_no;
            $data['billing_amount'] = $request->pay_amount;
            $data['billing_method'] = $request->billing_method;
            $data['billing_details'] = $request->billing_details;
            $data['billing_date'] = date('Y-m-d');
            $billData = DB::table('vendor_assign_projects')->where('pi_number',$request->pi_number)->orderBy('id', 'DESC')->get();
            foreach ($billData as $bill){
                if ($bill->total_pay == null){
                    DB::table('vendor_billing_histories')->insert($data);
                    DB::table('vendor_assign_projects')->where('pi_number',$request->pi_number)
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

                    DB::table('vendor_billing_histories')->insert($data);
                    DB::table('vendor_assign_projects')->where('pi_number',$request->pi_number)
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
