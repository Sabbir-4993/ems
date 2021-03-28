<?php

namespace App\Http\Controllers;

use App\Vendor;
use Illuminate\Http\Request;
Use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::orderBy('id', 'DESC')->get();
        return view('admin.vendor.index',compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vendor.create');
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
            'created_by'=>'',
        ]);

        $vendor = new Vendor();
        $vendor->vendor_name = $request->name;
        $vendor->vendor_phone = $request->phone;
        $vendor->vendor_address = $request->address;
        $vendor->assign_by = $request->referBy;
        $vendor->vendor_details = $request->details;
        $vendor->created_by = $request->created_by;
        $vendor->save();
        return redirect()->route('vendor.index')->with('message', 'vendor Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendors = Vendor::find($id);
        return view('admin.vendor.edit', compact('vendors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vendor = array();
        $vendor['vendor_name'] = $request->name;
        $vendor['vendor_phone'] = $request->phone;
        $vendor['vendor_address'] = $request->address;
        $vendor['assign_by'] = $request->referBy;
        $vendor['vendor_details'] = $request->details;
        $vendor['created_by'] = $request->created_by;
        DB::table('vendors')->where('id',$id)->update($vendor);

        return redirect()->route('vendor.index')->with('message', 'vendor Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor = Vendor::find($id);
        $vendor->delete();
        return redirect()->route('vendor.index')->with('message', 'Vendor Deleted Successfully');
    }
}
