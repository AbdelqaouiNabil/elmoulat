<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', function () {
    return view('layouts.app');
});
// Route::get('/', function () {
//     return view('admin.ouvriers');
// });


Route::middleware(['middleware'=>'PreventBack'])->group(function () {
    Auth::routes();
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



// Admin Routes


Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin','auth','PreventBack']], function(){
    Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('dashboard/projects',[AdminController::class,'projects'])->name('admin.projects');
    Route::get('dashboard/fournisseurs',[AdminController::class,'fournisseurs'])->name('admin.fournisseurs');
    Route::get('dashboard/ouvriers',[AdminController::class,'ouvriers'])->name('admin.ouvriers');
    
});







//  normal user routes

Route::group(['prefix'=>'user', 'middleware'=>['isUser','auth','PreventBack']], function(){

Route::get('dashboard',[UserController::class,'index'])->name('user.dashboard');
});


