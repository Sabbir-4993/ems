<?php

namespace App\Http\Controllers;

use App\Material;
use App\MaterialCategory;
use Illuminate\Http\Request;

class MaterialCategoryController extends Controller
{
    public function catindex(){
        return view('admin.material.create_material_category');
    }

    public function catview(){
        $category = MaterialCategory::orderBy('id', 'DESC')->get();
        return view('admin.material.material_category_list', compact('category'));
    }

    public function catstore(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'details'=>'',
    ]);
        $data = $request->all();
        MaterialCategory::create($data);
        return redirect()->back()->with('message', 'Category Created Successfully');
    }

    public function update(Request $request, $id){

        $category = MaterialCategory::find($id);
        $data = $request->all();
        $category->update($data);
        return redirect()->route('admin.material.material_category_list', 'category')->with('message', 'Category Updated Successfully');
    }

    public function destroy($id){

        $category = MaterialCategory::find($id);
        $category->delete();
        return redirect()->back()->with('message', 'Category Deleted Successfully');
    }
}
