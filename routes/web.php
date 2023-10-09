<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnonceController;
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


Route::get('/', function () {
    return view('layouts.main');
})->name('main');


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

    Route::get('/dashboard/profil', [ProfilController::class, 'dashboard'])->name('dashboard_profil');
    Route::post('/dashboard/profil/{id}', [ProfilController::class, 'update'])->name('modifierProfil');

    Route::get('/completerProfil', [ProfilController::class, 'completerProfil'])->name('completerProfil');

    Route::get('profil/annonces', [AnnonceController::class, 'index'])->name('mesAnnonces');
    Route::get('profil/annonce/create', [AnnonceController::class, 'create'])->name('createAnnonce');
    Route::post('profil/annonce/create', [AnnonceController::class, 'store']);
    Route::put('profil/annonces/modifier/{annonce}',[AnnonceController::class,'update'])->name('modifierAnnonce');
    Route::delete('/annonces/supprimer/{id}', [AnnonceController::class, 'destroy'])->name('supprimerAnnonce');
});
