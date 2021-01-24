<?php

namespace App\Http\Controllers;

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

}
