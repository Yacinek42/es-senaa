<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Wilaya;
use App\Models\Daira;
use App\Models\Commune;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Routes pour les listes déroulantes (AJAX)
|--------------------------------------------------------------------------
*/

Route::get('/get-dairas/{wilaya_id}', function ($wilaya_id) {
    // Récupère les daira liées à la wilaya choisie
    return Daira::where('wilaya_id', $wilaya_id)->get();
});

Route::get('/get-communes/{daira_id}', function ($daira_id) {
    // Récupère les communes liées à la daira choisie
    return Commune::where('daira_id', $daira_id)->get();
});