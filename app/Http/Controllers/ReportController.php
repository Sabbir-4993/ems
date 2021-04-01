<?php

namespace App\Http\Controllers;

use App\Contractor;
use App\Model\BillingHistory;
use App\Project;
use App\Vendor;
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

    public function billPrint($id){
        $printDetails = BillingHistory::where('id',$id)->first();
        $project = Project::where('id',$printDetails->project_id)->first();
        $contractor = Contractor::where('id',$printDetails->contractor_id)->first();
        $workOrder =DB::table('work_orders')->where('id',$printDetails->project_work_no)->first();

        return view('admin.contractor.bill.printBill',compact('printDetails','project','contractor','workOrder'));
    }

    public function totalBillPrint($id){

        $printDetails =  DB::table('assingproject')->where('work_order',$id)->first();
        $project = Project::where('id',$printDetails->project_id)->first();
        $billingDetails = BillingHistory::where('work_order',$id)->get();
        $contractor = Contractor::where('id',$printDetails->contractor_id)->first();
        $workOrder =DB::table('work_orders')->where('id',$printDetails->project_work_order)->first();
        return view('admin.contractor.bill.totalPrintBill',compact('billingDetails','project','contractor','workOrder','printDetails'));
    }
}
