<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnonceController;

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

Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::post('/register',[RegisterController::class,'store']);

Route::get('/login', [LoginController::class, 'index']);

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');
Route::middleware(['auth', 'admin'])->group(function () {
    // Cette route ne sera accessible que pour les utilisateurs authentifiés en tant qu'administrateurs.
    Route::get('/admin', [AdminController::class, 'index'])->name('adminRedirect');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin/dashboard');
    
});
Route::get('/createAnnonce',[AnnonceController::class,'index'])->name('createAnnonce');
Route::post('/createAnnonce', [AnnonceController::class, 'store']);