<?php

namespace App\Http\Controllers;

use App\MaterialCategory;
use Illuminate\Http\Request;

class MaterialCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materialcategory = MaterialCategory::orderBy('id', 'DESC')->get();
        return view('admin.material.index_material_category', compact('materialcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.material.create_material_category');
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
            ]
        );
        $materialcategory = new MaterialCategory();
        $materialcategory->name = $request->name;
        $materialcategory->details = $request->details;

        $materialcategory->save();
        return redirect()->back()->with('message','Category Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MaterialCategory  $materialCategory
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialCategory $materialCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MaterialCategory  $materialCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $materialcategory = MaterialCategory::find($id);
        return view('admin.material.edit_material_category', compact('materialcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MaterialCategory  $materialCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $materialcategory = MaterialCategory::find($id);
        $data = $request->all();
        $materialcategory->update($data);
        return redirect()->route('material_category.index')->with('message', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MaterialCategory  $materialCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaterialCategory $materialCategory)
    {
        //
    }
}
