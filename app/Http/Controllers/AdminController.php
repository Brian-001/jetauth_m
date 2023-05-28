<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Notifications\TemporaryPasswordNotification;

class AdminController extends Controller
{
    //
    // public function dashboard()
    // {
    //     //Create Editor User
    //     $editorUser = User::create([
    //         'name' => 'Editor User',
    //         'email' => 'editor@example.com',
    //         'password' => Hash::make(Str::random(10)),
    //         'role' => 'editor',
    //     ]);

    //     //Create Designer User
    //     $designerUser = User::create([
    //         'name' => 'Designer User',
    //         'email' => 'designer@example.com',
    //         'password' => Hash::make(Str::random(10)),
    //         'role' => 'designer',
    //     ]);

    //     $adminUser = User::where('role', 'admin')->first();
    //     if ($adminUser) {
    //         return view('admin.dashboard');
    //     }
    //     //Create a temporary password for the admin 
    //     $temporaryPassword = 'adminadmin';

    //     //Create the admin user
    //     $adminUser = User::create([
    //         'name' => 'BrianK',
    //         'email' => 'bkanyi@gretsauniversity.ac.ke',
    //         'password' => Hash::make($temporaryPassword),
    //         'role' => 'admin',
    //     ]);

    //     //Send a notification to the admin user with the temporary password
    //     $adminUser->notify(new TemporaryPasswordNotification($temporaryPassword));

    //     return view('admin.dashboard');
    // }

    // //Change Password functionality
    // public function changePassword()
    // {
    //     return view('admin.change-password');
    // }

    // //Update password functionality
    // public function updatePassword(Request $request){

    //     /** @var \App\Models\User $user */
    //     $user = Auth::user();

    //     $request->validate([
    //         'password'=> ['required', 'string', 'min:8','confirmed' ],
    //     ]);
    //     $user->password = Hash::make($request->password);
    //     $user->save();

    //     return redirect('/admin/dashboard')->with('status', 'Password changed successfully!');
    // }

    public function dashboard()
    {
        $adminUser = User::where('role', 'admin')->first();

        if (!$adminUser) {
            // Create a temporary password for the admin
            $temporaryPassword = Str::random(10);

            // Create the admin user
            $adminUser = User::create([
                'name' => 'Brian Karanja',
                'email' => 'karanjabrian001@gmail.com',
                'password' => Hash::make($temporaryPassword),
                'role' => 'admin',
            ]);

            // Send a notification to the admin user with the temporary password
            $adminUser->notify(new TemporaryPasswordNotification($temporaryPassword));

            return view('admin.admin-registration')->with('temporaryPassword', $temporaryPassword);
        }

        return view('admin.dashboard')->with('adminUser', $adminUser);
    }

    // public function createEditor(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|string|min:8',
    //     ]);

    //     $editorUser = User::create([
    //         'name' => $request->input('name'),
    //         'email' => $request->input('email'),
    //         'password' => Hash::make($request->input('password')),
    //         'role' => 'editor',
    //     ]);

    //     return redirect()->back()->with('status', 'Editor user created successfully!');
    // }

    // public function createDesigner(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|string|min:8',
    //     ]);

    //     $designerUser = User::create([
    //         'name' => $request->input('name'),
    //         'email' => $request->input('email'),
    //         'password' => Hash::make($request->input('password')),
    //         'role' => 'designer',
    //     ]);

    //     return redirect()->back()->with('status', 'Designer user created successfully!');
    // }



}
