<?php

namespace App\Http\Controllers;

use App\Model\BillingHistory;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class ReportController extends Controller
{
    public function ContractorBill(){
        $today = date('Y-m-d');
        $bill = BillingHistory::where('billing_date', $today)->get();
        return view('admin.contractor.contractorReport', compact('bill'));
    }
    public function BillSearch(Request  $request){

        $from = $request->from;
        $to = $request->to;

        $billReport = DB::table('billing_histories')
            ->join('projects', 'billing_histories.project_id', '=', 'projects.id')
            ->join('work_orders', 'billing_histories.project_work_no', '=', 'work_orders.id')
            ->join('contractors', 'billing_histories.contractor_id', '=', 'contractors.id')
            ->select('billing_histories.*','projects.project_name','work_orders.work_order','contractors.contractor_name')
            ->whereBetween('billing_histories.billing_date', [$from, $to])
            ->where('billing_histories.project_id', $request->project_id)
            ->where('billing_histories.contractor_id', $request->contractor_name)
            ->where('billing_histories.project_work_no', $request->work_order)
            ->get();
            return response()->json($billReport);

    }
    public function todayReport(){
        $today = date('Y-m-d');
        $billReport = DB::table('billing_histories')
            ->join('projects', 'billing_histories.project_id', '=', 'projects.id')
            ->join('work_orders', 'billing_histories.project_work_no', '=', 'work_orders.id')
            ->join('contractors', 'billing_histories.contractor_id', '=', 'contractors.id')
            ->select('billing_histories.*','projects.project_name','work_orders.work_order','contractors.contractor_name')
            ->where('billing_histories.project_work_no', $today)
            ->get();
        return response()->json($billReport);
    }
    public function weeklyReport(){
        $billReport = DB::table('billing_histories')
            ->join('projects', 'billing_histories.project_id', '=', 'projects.id')
            ->join('work_orders', 'billing_histories.project_work_no', '=', 'work_orders.id')
            ->join('contractors', 'billing_histories.contractor_id', '=', 'contractors.id')
            ->select('billing_histories.*','projects.project_name','work_orders.work_order','contractors.contractor_name')
            ->whereBetween('billing_histories.billing_date', [\Carbon\Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get();
        return response()->json($billReport);
    }
}
