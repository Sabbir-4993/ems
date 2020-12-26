<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = User::orderBy('id', 'DESC')->get();
        return view('admin.employee.index', compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string',
            'mobile_number' => 'required',
            'address' => 'required',
            'blood_group' => 'required',
            'join_date' => 'required',
            'salary' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048',
            'department_id' => 'required',
            'designation' => 'required',
            'emp_type' => 'required',
            'emp_status' => 'required',
        ]);
        $data = $request->all();

//        if ($request->hasFile('image')) {
//            $image = $request->file('image');
//            $name = time().'.'.$image->getClientOriginalExtension();
//            $destinationPath = public_path('/uploads/profile');
//            $image->move($destinationPath, $name);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = date('Y-m-d').'-'.time().'-'.$request->first_name.'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/profile');
            $image->move($destinationPath, $name);
            $image_url = $name;

        }else{
            $image = 'avater.png';
        }

        $data['name'] = $request->first_name.' '.$request->last_name;
        $data['image'] = $image_url;
        $data['password'] = bcrypt($request->password);

        User::create($data);
        return redirect()->back()->with('message', 'Employee Created Successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = User::find($id);
        return view('admin.employee.view', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
