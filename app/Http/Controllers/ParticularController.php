<?php

namespace App\Http\Controllers;

use App\Model\Particular;
use Illuminate\Http\Request;

class ParticularController extends Controller
{
    public function store( Request  $request)
    {
        $input = $request->all();
        Particular::create($input);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
    }
    public function allPaticular()
    {
        $particular = Particular::all();
        return response()->json($particular);
    }
    public function destroy($id){
        $particular = Particular::find($id);
        $particular->delete();
        return redirect()->back();


    }
}
