<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DesignerController extends Controller
{
    //
    public function index(){
     $designers = User::where('role', 'designer')->get();
     return view('admin.designers.index', compact('designer'));   
    }

    public function create(){
        return view('admin.designers.create');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>'designer',
        ]);

        return redirect()->route('admin.designers.create')->with('success', 'Designer created successfully');
    }

    
}
