<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Livewire\ProjectSection\FournisseursList;
use App\Http\Livewire\ProjectSection\ProjectsList;
use App\Http\Livewire\RhSection\BureauList;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\ownerDashboard;
use App\Models\User;


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


// Route::get('/', function () {
//     return view('admin.ouvriers');
// });

Route::get('/', function () {
    return view('auth.login');
});
Route::middleware(['middleware'=>'PreventBack'])->group(function () {
    
    Auth::routes();
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/addRole', function(){
    $admin = User::where('email','admin@gmail.com')->first();
    $admin->attachRole('admin');
    $owner = User::where('email','owner@gmail.com')->first();
    $owner->attachRole('owner');
});



// Admin Routes


    Route::group(['prefix'=>'admin', 'middleware' => ['role:admin','auth','PreventBack']], function(){
        Route::get('/dashboard',ownerDashboard::class)->name('owner.dashboard');
            
     });


    Route::group(['prefix'=>'owner', 'middleware' => ['role:owner','auth','PreventBack']], function(){
        Route::get('/liste-fournisseurs',FournisseursList::class)->name('admin.fournisseurList');
        Route::get('/liste-projets',ProjectsList::class)->name('admin.projects');
        Route::get('/liste-ouvriers',ProjectsList::class)->name('admin.ouvriers');
        Route::get('/dashboard',Dashboard::class)->name('admin.dashboard'); 




        Route::get('/liste-bureau',BureauList::class)->name('admin.bureau'); 


    });







//  normal user routes

Route::group(['prefix'=>'user', 'middleware'=>['isUser','auth','PreventBack']], function(){

Route::get('dashboard',[UserController::class,'index'])->name('user.dashboard');
});


