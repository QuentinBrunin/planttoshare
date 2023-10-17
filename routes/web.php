<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfilController;

use Illuminate\Http\Request;

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
    return view('app');
});




Route::get('/',[Controller::class,'welcolm'])->name('main');
Route::get('/dons',[Controller::class,'index'])->name('dons');
Route::get('/getFilteredAnnonces/{category}', [AnnonceController::class, 'getFilteredAnnonces'])->name('getFilteredAnnonces');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index']);

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('adminRedirect');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin/dashboard');
});

Route::middleware(['auth',])->group(function () {

    Route::get('profil/infos', [ProfilController::class, 'index'])->name('InfosProfil');
    Route::put('profil/infos/modifier/{user}', [ProfilController::class,'update'])->name('modifierProfil');

    Route::get('/completerProfil', [ProfilController::class, 'completerProfil'])->name('completerProfil');

    Route::get('profil/annonces', [AnnonceController::class, 'index'])->name('mesAnnonces');
    Route::get('profil/annonce/create', [AnnonceController::class, 'create'])->name('createAnnonce');
    Route::post('profil/annonce/create', [AnnonceController::class, 'store']);
    Route::put('profil/annonces/modifier/{annonce}',[AnnonceController::class,'update'])->name('modifierAnnonce');
    Route::delete('/annonces/supprimer/{id}', [AnnonceController::class, 'destroy'])->name('supprimerAnnonce');
});
