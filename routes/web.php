<?php

use App\Http\Livewire\ChargesList;
use App\Http\Livewire\ChequeList;
use App\Http\Livewire\ClientList;
use App\Http\Livewire\ContratsList;
use App\Http\Livewire\DepensesList;
use App\Http\Livewire\FactureList;
use App\Http\Livewire\ProjectSection\OuvriersList;
use App\Http\Livewire\ReglementsList;
use App\Http\Livewire\RhSection\BureauList;
use App\Http\Livewire\CaisseList;
use App\Http\Livewire\RhSection\CongeList;
use App\Http\Livewire\RhSection\EmployeList;
use App\Http\Livewire\Settings\BankList;
use App\Http\Livewire\Settings\UsersList;
use App\Http\Livewire\Settings\RolesList;
use App\Http\Livewire\Settings\DomaineList;
use App\Http\Livewire\Transactions\ChequierList;
use App\Http\Livewire\Transactions\ComptesList;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Livewire\ProjectSection\FournisseursList;
use App\Http\Livewire\ProjectSection\ProjectsList;
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
Route::get('/', function () {
    return view('auth.login');
});
Route::middleware(['middleware'=>'PreventBack'])->group(function () {

    Auth::routes();
});

// Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/addRole', function(){
    $admin = User::where('email','admin@gmail.com')->first();
    $admin->attachRole('admin');
    $owner = User::where('email','owner@gmail.com')->first();
    $owner->attachRole('owner');
});



// Admin Routes


Route::group(['prefix'=>'admin', 'middleware'=>['role:admin','auth','PreventBack']], function(){
    Route::get('/dashboard',Dashboard::class)->name('admin.dashboard');
    Route::get('/Projetslist',ProjectsList::class)->name('admin.projects');
    Route::get('/fournisseurlist',FournisseursList::class)->name('admin.fournisseurs');
    Route::get('/ouvrierlist',OuvriersList::class)->name('admin.ouvriers');
    Route::get('/facturelist',FactureList::class)->name('admin.factures');
    Route::get('/clientlist',ClientList::class)->name('admin.clients');
    Route::get('/chargeliste',ChargesList::class)->name('admin.charges');
    Route::get('/contratlist',ContratsList::class)->name('admin.contrats');
    Route::get('/depenselist',DepensesList::class)->name('admin.depenses');
    Route::get('/reglementlist',ReglementsList::class)->name('admin.reglements');
    Route::get('/comptelist',ComptesList::class)->name('admin.comptes');
    // Route::get('/comptelist',Relever::class)->name('admin.compte');
    Route::get('/chequierlist',ChequierList::class)->name('admin.chequiers');
    Route::get('/bureaulist',BureauList::class)->name('admin.bureaus');
    Route::get('/domainelist',DomaineList::class)->name('admin.domaines');
    Route::get('/congelist',CongeList::class)->name('admin.conges');
    Route::get('/employelist',EmployeList::class)->name('admin.employes');
    Route::get('/banklist',BankList::class)->name('admin.banks');
    Route::get('/cheques',ChequeList::class)->name('admin.cheques');
    Route::get('/caisse',CaisseList::class)->name('admin.caisses');
    Route::get('/Pdf',[ProjectsList::class,'pdfExport'])->name('admin.pdf');


});



    Route::group(['prefix'=>'owner', 'middleware' => ['role:owner','auth','PreventBack']], function(){
          Route::get('/dashboard',Dashboard::class)->name('owner.dashboard');
    Route::get('/Projetslist',ProjectsList::class)->name('owner.projects');
    Route::get('/fournisseurlist',FournisseursList::class)->name('owner.fournisseurs');
    Route::get('/ouvrierlist',OuvriersList::class)->name('owner.ouvriers');
    Route::get('/facturelist',FactureList::class)->name('owner.factures');
    Route::get('/clientlist',ClientList::class)->name('owner.clients');
    Route::get('/chargeliste',ChargesList::class)->name('owner.charges');
    Route::get('/contratlist',ContratsList::class)->name('owner.contrats');
    Route::get('/depenselist',DepensesList::class)->name('owner.depenses');
    Route::get('/reglementlist',ReglementsList::class)->name('owner.reglements');
    Route::get('/comptelist',ComptesList::class)->name('owner.comptes');
    Route::get('/chequierlist',ChequierList::class)->name('owner.chequiers');
    Route::get('/bureaulist',BureauList::class)->name('owner.bureaus');
    Route::get('/domainelist',DomaineList::class)->name('owner.domaines');
    Route::get('/congelist',CongeList::class)->name('owner.conges');
    Route::get('/employelist',EmployeList::class)->name('owner.employes');
    Route::get('/banklist',BankList::class)->name('owner.banks');
    Route::get('/list-utilisateurs',UsersList::class)->name('owner.users');
    Route::get('/list-roles',RolesList::class)->name('owner.role');




    });








//  normal user routes

Route::group(['prefix'=>'user', 'middleware'=>['isUser','auth','PreventBack']], function(){

Route::get('dashboard',[UserController::class,'index'])->name('user.dashboard');
});


