<?php

namespace App\Http\Controllers;

use App\Model\BillingHistory;
use App\Project;
use App\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorReportController extends Controller
{
    public function vendorBill(){
        return view('admin.vendor.bill.vendorReport');
    }
    public function billSearch(Request  $request){

        $from = $request->from;
        $to = $request->to;

        $billReport = DB::table('vendor_billing_histories')
            ->join('projects', 'vendor_billing_histories.project_id', '=', 'projects.id')
            ->join('work_orders', 'vendor_billing_histories.project_work_no', '=', 'work_orders.id')
            ->join('vendors', 'vendor_billing_histories.vendor_id', '=', 'vendors.id')
            ->select('vendor_billing_histories.*','projects.project_name','work_orders.work_order','vendors.vendor_name')
            ->where('vendor_billing_histories.project_id', $request->project_id)
            ->where('vendor_billing_histories.project_work_no', $request->work_order)
            ->where('vendor_billing_histories.vendor_id', $request->vendor_name)
            ->whereBetween('vendor_billing_histories.billing_date', [$from, $to])
            ->get();
        return response()->json($billReport);

    }
    public function todayReport(){

        $today = date('Y-m-d');
        $billReport = DB::table('vendor_billing_histories')
            ->join('projects', 'vendor_billing_histories.project_id', '=', 'projects.id')
            ->join('work_orders', 'vendor_billing_histories.project_work_no', '=', 'work_orders.id')
            ->join('vendors', 'vendor_billing_histories.vendor_id', '=', 'vendors.id')
            ->select('vendor_billing_histories.*','projects.project_name','work_orders.work_order','vendors.vendor_name')
            ->where('vendor_billing_histories.billing_date', $today)
//            ->whereBetween('vendor_billing_histories.billing_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get();
        return response()->json($billReport);
    }
    public function weeklyReport(){
        $billReport = DB::table('vendor_billing_histories')
            ->join('projects', 'vendor_billing_histories.project_id', '=', 'projects.id')
            ->join('work_orders', 'vendor_billing_histories.project_work_no', '=', 'work_orders.id')
            ->join('vendors', 'vendor_billing_histories.vendor_id', '=', 'vendors.id')
            ->select('vendor_billing_histories.*','projects.project_name','work_orders.work_order','vendors.vendor_name')
            ->whereBetween('vendor_billing_histories.billing_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get();
        return response()->json($billReport);
    }

    public function billPrint($id){
        $printDetails = DB::table('vendor_billing_histories')->where('id',$id)->first();
        $project = Project::where('id',$printDetails->project_id)->first();
        $vendor = Vendor::where('id',$printDetails->vendor_id)->first();
        $workOrder =DB::table('work_orders')->where('id',$printDetails->project_work_no)->first();

        return view('admin.vendor.bill.printBill',compact('printDetails','project','vendor','workOrder'));
    }
    public function totalBillPrint($id){
        $printDetails =  DB::table('vendor_assign_projects')->where('pi_number',$id)->first();
        $project = Project::where('id',$printDetails->project_id)->first();
        $billingDetails = DB::table('vendor_billing_histories')->where('pi_number',$id)->get();
        $contractor = Vendor::where('id',$printDetails->vendor_id)->first();
        $workOrder =DB::table('work_orders')->where('id',$printDetails->project_work_order)->first();
        return view('admin.vendor.bill.totalPrintBill',compact('billingDetails','project','contractor','workOrder','printDetails'));

    }

}
