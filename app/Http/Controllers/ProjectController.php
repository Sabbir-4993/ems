<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = project::orderBy('id', 'DESC')->get();
        return view('admin.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'project_name' => 'required',
            'company_name' => 'required',
            'address' => 'required',
            'company_email' => 'required',
            'phone' => 'required',
            'status' => 'required',
            'est_budget' => 'required',
            'total_amount' => 'required',
            'pro_duration' => 'required',
            'project_start' => 'required',
            'project_end' => 'required',
        ]);

        $data = $request->all();
        project::create($data);
        return redirect()->back()->with('message', 'Project Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projects = project::find($id);
        return view('admin.project.view', compact('projects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = project::find($id);
        return view('admin.project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = project::find($id);
        $data = $request->all();
        $project->update($data);
        return redirect()->route('project.index')->with('message', 'Project Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = project::find($id);
        $project->delete();
        return redirect()->route('project.index')->with('message', 'Project Deleted Successfully');
    }

    public function order(Request $request){

//        $this->validate($request,[
//            'project_id' => 'required',
//            'work_order' => 'required',
//            'status' => 'required',
//            'details' => 'required',
//            'created_by' => 'required',
//        ]);
//        $data = array();
//        $data['project_id'] = $request->project_id;
//        $data['work_order'] = $request->work_order;
//        $data['status'] = $request->status;
//        $data['details'] = $request->details;
//        $data['created_by'] = $request->created_by;


        return view('admin.project.workorder');

//        dd($data);
//        DB::table('workorder')->insert($data);
//        return redirect()->route('project.store')->with('message', 'Work Order Created Successfully');



    }

    public function list(){
        $project = Project::orderBy('id', 'DESC')->get();
        return view('admin.project.workorderlist', compact('project'));
    }

}
