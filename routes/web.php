<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Actions\Fortify\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//Create a hidden route for admin login
Route::get('/admin/admin-login', function () {
    return view('admin/admin-login');
})->name('admin.admin-login');

Route::post('/admin/admin-login', [AuthenticatedSessionController::class, '__invoke'])->name('admin.admin-login.store');

//Protect admin dashboard route using admin middleware


Route::middleware(['admin'])->group(function () {
    Route::post('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/admin/change-password', [AdminController::class, 'changePassword'])->name('admin.admin-change-password');
    Route::post('/admin/change-password', [AdminController::class, 'updatePassword'])->name('admin.admin-update-password');
    // Route::post('/admin/create-editor', 'AdminController@createEditor')->name('admin.create-editor');
    // Route::post('/admin/create-designer', 'AdminController@createDesigner')->name('admin.create-designer');

});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/editor/dashboard', 'dashboard.editor')->name('editor.dashboard');
    Route::view('/designer/dashboard', 'dashboard.designer')->name('designer.dashboard');
    Route::view('/normal/dashboard', 'dashboard.normal')->name('normal.dashboard');
});