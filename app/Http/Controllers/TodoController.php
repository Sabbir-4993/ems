<?php

namespace App\Http\Controllers;

use App\Model\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{

    public function storeTodo( Request  $request){
        $todo = new Todo();
        $todo['work_title'] = $request->todo_title;
        $todo['work_description'] = $request->todo_details;
        $todo['employee_id'] = Auth()->id();
        $todo['added_date'] = date('d/m/y');
        $todo['status'] = '0';
        $todo ->save();
        return redirect()->back();

    }
    public function deleteTodo( $id){
        $todo = Todo::find($id);
        $todo->delete();
        return redirect()->back();

    }
}
