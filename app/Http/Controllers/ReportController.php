<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function ContractorBill(){
        $today = date('d/m/y');
        $bill = DB::table('billing_histories')->where('id')->where('billing_date', $today)->get();
        return view('admin.contractor.contractorreport', compact('bill'));


    }
}
