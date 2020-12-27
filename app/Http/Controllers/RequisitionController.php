<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequisitionController extends Controller
{
    public function index(){
        return view('admin.requisition.create');
    }
}
