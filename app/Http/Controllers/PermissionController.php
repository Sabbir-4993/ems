<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission = Permission::orderBy('id', 'DESC')->get();
        return view('admin.permission.index', compact('permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id'=>'required|unique:permissions',
            'designation_id' => 'required',
        ]);

//        dd($request);
//        Permission::create($data);
        Permission::create($request->all());
        return redirect()->back()->with('message', 'Permission Created Successfully');
    }

    public function getUser(Request $request){
        $id = $request->designation_id;
        $users = DB::table('users')->where('designation', $id)
            ->select('id', 'name')
            ->get();

        return response()->json($users);
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
    public function edit(Request $request, $id)
    {
//        $permission = DB::table('permissions')->select($id);
        $permission = Permission::find($id);
        return view('admin.permission.edit', compact('permission'));
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
        $permission = Permission::find($id);
        $data = $request->all();
        $permission->update($data);
//        Permission::update($request->all());
        return redirect()->route('permission.index')->with('message', 'Permission Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return redirect()->back()->with('message', 'permissions Deleted Successfully');
    }

}
