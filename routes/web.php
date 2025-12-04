<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB; // Important : On importe la façade DB
use App\Models\Wilaya;
use App\Models\Daira;
use App\Models\Commune;
use App\Models\NiveauScolaire;

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
    // Récupération des données dynamiques
    // On utilise 'num' pour le tri (1..58)
    $wilayas = Wilaya::orderBy('num')->get(); 
    $niveaux = NiveauScolaire::all();

    return view('welcome', compact('wilayas', 'niveaux'));
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

// Récupère les dairas directement via la table 'daira' (singulier)
Route::get('/get-dairas/{wilaya_id}', function ($wilaya_id) {
    // On force l'utilisation de la table 'daira' pour éviter les erreurs de modèle
    return DB::table('daira')
                ->where('wilaya_id', $wilaya_id)
                ->orderBy('daira') // Tri par ordre alphabétique
                ->get();
});

// Récupère les communes directement via la table 'commune' (singulier)
Route::get('/get-communes/{daira_id}', function ($daira_id) {
    // On force l'utilisation de la table 'commune'
    return DB::table('commune')
                  ->where('daira_id', $daira_id)
                  ->orderBy('commune') // Tri par ordre alphabétique
                  ->get();
});