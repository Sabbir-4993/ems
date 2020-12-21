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
            'contractor_name' => 'required|max:100',
            'contractor_number' => 'required|max:100',
            'contractor_type' => 'required|max:100',
            'project_name' => 'required|max:100',
            'assign_date' => 'required|max:100',
            'end_date' => 'required|max:100',
            'total_payable' => 'required|max:100',
            'assign_by' => 'required|max:100',
        ]);

        $contractor = new Contractor();
        $contractor->contractor_name = $request->contractor_name;
        $contractor->contractor_phone = $request->contractor_number;
        $contractor->contractor_type = $request->contractor_type;
        $contractor->project_id = $request->project_name;
        $contractor->assign_date = $request->assign_date;
        $contractor->end_date = $request->end_date;
        $contractor->total_payable = $request->total_payable;
        $contractor->assign_by = $request->assign_by;
        $contractor->save();
        return redirect()->back()->with('message','Contractor Created Successfully');
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
        $request->validate([
            'contractor_name' => 'required|max:100',
            'contractor_number' => 'required|max:100',
            'contractor_type' => 'required|max:100',
            'project_name' => 'required|max:100',
            'assign_date' => 'required|max:100',
            'end_date' => 'required|max:100',
            'total_payable' => 'required|max:100',
            'assign_by' => 'required|max:100',
        ]);

        $contractor = array();
        $contractor['contractor_name'] = $request->contractor_name;
        $contractor['contractor_phone'] = $request->contractor_number;
        $contractor['contractor_type'] = $request->contractor_type;
        $contractor['project_id'] = $request->project_name;
        $contractor['assign_date'] = $request->assign_date;
        $contractor['end_date'] = $request->end_date;
        $contractor['total_payable'] = $request->total_payable;
        $contractor['assign_by'] = $request->assign_by;
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
}
