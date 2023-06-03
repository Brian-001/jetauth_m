<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EditorController extends Controller
{
    //
    public function index(){
        $editors = User::where('role', 'editor')->get();
        return view('admin.editors.index', compact('editors'));
    }

    public function create(){
        return view('admin.editors.create');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>'editor',
        ]);
        return redirect()->route('admin.editors')->with('success', 'Editor created successfully');
    }

}
