<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){

        $id = Auth::user()->id;
        $user = User::where('id', $id)->first();
        return view('admin.profile.profile',compact('user'));
    }

    public function reset(Request $request){

        $this->validate($request, [
                'OldPassword' => 'required',
                'password' => 'required',
                'confirm_password' => 'required|same:password|min:6'
        ]);

        if (Hash::check($request->OldPassword, Auth::user()->password)) {
            User::where('email',$request->email)->update(['password'=>Hash::make($request['password'])]);
            Auth::logout();
            return redirect()->route('home');

        } else {
            return redirect()->back()->with('message', 'Current Password not Match');
        }
    }
}
