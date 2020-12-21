<?php

namespace App\Http\Controllers;

use App\Contractor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContractorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contractors = Contractor::orderBy('id', 'DESC')->get();;
        return view('admin.contractor.index',compact('contractors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contractor.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'phone' => 'required|max:100',
            'address' => 'required|max:100',
            'referBy' => 'required|max:100',
            'details' => 'required|max:100',
        ]);

        $contractor = new Contractor();
        $contractor->contractor_name = $request->name;
        $contractor->contractor_phone = $request->phone;
        $contractor->contractor_address = $request->address;
        $contractor->assign_by = $request->referBy;
        $contractor->contractor_details = $request->details;
        $contractor->save();
        return redirect()->route('contractors.index')->with('message', 'Contractor Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contractors = Contractor::find($id);
        return view('admin.contractor.edit', compact('contractors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $contractor = array();
        $contractor['contractor_name'] = $request->name;
        $contractor['contractor_phone'] = $request->phone;
        $contractor['contractor_address'] = $request->address;
        $contractor['assign_by'] = $request->referBy;
        $contractor['contractor_details'] = $request->details;
        DB::table('contractors')->where('id',$id)->update($contractor);

        return redirect()->route('contractors.index')->with('message', 'Contractor Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Contractor::find($id);
        $department->delete();
        return redirect()->route('contractors.index')->with('message', 'Contractor Deleted Successfully');
    }
//    public function payBill($id)
//    {
//        $contractors = Contractor::where('id',$id)->first();
//        return view('admin.contractor.payBill', compact('contractors'));
//    }
//    public function BillPaid(Request  $request)
//    {
//        $contractor = array();
//        $contractor['paid'] = $request->pay;
//        $contractor['pay_date'] = $request->billing_date;
//        DB::table('contractors')->where('id',$request->id)->update($contractor);
//        DB::table('contractors')->where('id',$request->id)
//            ->update(['due'=>DB::raw('total_payable -'.$request->pay )]);
//        return redirect()->route('contractors.index')->with('message', 'Contractor Bill Paid Successfully');
//
//    }
}
