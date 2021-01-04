<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Imports\MaterialImport;
use Maatwebsite\Excel\Excel;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $material=DB::table('materials')->orderBy('id', 'DESC')->get();
        return view('admin.material.index', compact('material'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.material.create');
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
            'material_name' => 'required',
            'category' => 'required',
            'unit' => 'required',
            'price' => 'required',
            'details' => 'required',
        ]);

        $material = new Material();
        $material->material_name = $request->material_name;
        $material->category = $request->category;
        $material->unit = $request->unit;
        $material->price = $request->price;
        $material->details = $request->details;

        $material->save();
        return redirect()->back()->with('message','Material Created Successfully');

        $material_file = $request->material_file->store('/material_store');

        $import = new MaterialImport;
        $import->import($material_file);



        (new MaterialImport)->import($material_file);
        return redirect()->back()->with('message','Material Data Imported successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        //
    }


    public function upload(Request $request){

        $material_file = $request->material_file->store('/material_store');

        $import = new MaterialImport;
        $import->import($material_file);

        (new MaterialImport)->import($material_file);
        return redirect()->back()->with('message','Material Data Imported successfully.');

//        dd($import->failures());

//        $material_file = $request->material_file;
//
//        Excel::import(new ExcelImport($material_file));
//        echo "Success";
//
//        $this->validate($request, [
//            'material_file' => 'required|mimes:xls,xlsx'
//        ]);
//
//        $path = $request->file('material_file')->getRealPath();
//        $material = Excel::import(new ExcelImport(), $path);
//        if ($material->count() > 0){
//            foreach ($material->toArray() as $key => $value){
//                foreach ($value as $row){
//                    $insert_data[] = array(
//                        'name' => $row['name'],
//                        'category' => $row['category'],
//                        'unit' => $row['unit'],
//                        'price' => $row['price'],
//                        'details' => $row['details'],
//                    );
//                }
//            }
//            if(!empty($insert_data))
//            {
//                dd($insert_data);
//                DB::table('materials')->insert($insert_data);
//            }
//        }
//        return redirect()->back()->with('message','Excel Data Imported successfully.');
//
//        $this->validate($request,[
//            'name'=>'required',
//            'category'=>'required',
//            'unit'=>'required',
//            'price'=>'required',
//            'details'=>'required',
//        ]);
//
//        $material = new Material();
//        $material->name = $request->name;
//        $material->category = $request->category;
//        $material->unit = $request->unit;
//        $material->price = $request->price;
//        $material->details = $request->details;
//
//        $material->save();
//
//        return redirect()->back()->with('message','Material Created Successfully');
//
//
//        return back()->with('message', 'Successfully Added Material');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        //
    }
}

