<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\BureauController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ColisController;
use App\Http\Controllers\AdminBureau\ColisController as AdminBureauColisController;
use App\Http\Controllers\AdminRegion\BureauController as AdminRegionBureauController;
use App\Http\Controllers\AdminRegion\UserController as AdminRegionUserController;
use App\Http\Controllers\AdminRegion\ClientController as AdminRegionClientController;
use App\Http\Controllers\AdminRegion\ColisController as AdminRegionColisController;
use Illuminate\Support\Facades\Route;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Tableau de bord générique (après login)
Route::get('/dashboard', function () {
    return view('dashboards.admin_bureau');
})->middleware(['auth', 'verified'])->name('dashboard');

// Gestion du profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =========================
// 🔥 ADMIN GLOBAL
// =========================
Route::prefix('admin/global')->name('admin.global.')->middleware(['auth'])->group(function () {
    Route::get('/', fn() => view('dashboards.admin_global'))->name('dashboard');

    // CRUD Régions
    Route::resource('regions', RegionController::class);

    // CRUD Bureaux
    Route::resource('bureau', BureauController::class);

    // CRUD Utilisateurs
    Route::resource('users', UserController::class);

    // CRUD Clients
    Route::resource('clients', ClientController::class);

    // CRUD Colis
    Route::resource('colis', ColisController::class)->parameters(['colis' => 'colis']);

    // Colis d’un client
    Route::get('clients/{client}/colis', [ClientController::class, 'colis'])->name('clients.colis');

    // Ticket d’un colis
    Route::get('colis/{colis}/ticket', [ColisController::class, 'ticket'])->name('colis.ticket');
});

// Suivi d'un colis (code suivi) - route publique
Route::get('/tracking/{code_suivi}', [App\Http\Controllers\ColisController::class, 'track'])->name('tracking');

// =========================
// 🔥 ADMIN REGION
// =========================
Route::prefix('admin/region')->name('admin.region.')->middleware(['auth'])->group(function () {
    Route::get('/', fn() => view('dashboards.admin_region'))->name('dashboard');
    // CRUD Bureaux de la région
    Route::resource('bureau', AdminRegionBureauController::class);
    // CRUD Employés de la région
    Route::resource('users', AdminRegionUserController::class);
    // CRUD Clients de la région
    Route::resource('clients', AdminRegionClientController::class);
    // Colis d’un client (adminRegion)
    Route::get('clients/{client}/colis', [AdminRegionClientController::class, 'colis'])->name('clients.colis');
    // CRUD Colis de la région
    Route::resource('colis', AdminRegionColisController::class)->parameters(['colis' => 'colis']);
});

// =========================
// 🔥 ADMIN BUREAU
// =========================
Route::prefix('admin/bureau')->name('admin.bureau.')->middleware(['auth'])->group(function () {
    Route::get('/', fn() => view('dashboards.admin_bureau'))->name('dashboard');

    // CRUD Employés (users)
    Route::resource('users', \App\Http\Controllers\AdminBureau\UserController::class);

    // Employés du bureau
    Route::get('/employes', fn() => view('dashboards.bureau_employes'))->name('employes');

    // Colis du bureau
    Route::resource('colis', \App\Http\Controllers\AdminBureau\ColisController::class);

    // CRUD Clients du bureau
    Route::resource('clients', \App\Http\Controllers\AdminBureau\ClientController::class);
});

// =========================
// 🔥 EMPLOYÉ
// =========================
Route::prefix('employe')->name('employe.')->middleware(['auth'])->group(function () {
    Route::get('/', fn() => view('dashboards.employe'))->name('dashboard');

    // CRUD Clients (Employé)
    Route::resource('clients', \App\Http\Controllers\Employe\ClientController::class);

    // CRUD Colis (Employé)
    Route::resource('colis', \App\Http\Controllers\Employe\ColisController::class);

    // Gestion du profil employé
    Route::get('/profile', [\App\Http\Controllers\Employe\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\Employe\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\Employe\ProfileController::class, 'destroy'])->name('profile.destroy');

    // Colis d’un client (Employé)
    Route::get('clients/{client}/colis', [\App\Http\Controllers\Employe\ClientController::class, 'colis'])->name('clients.colis');
});

// =========================
// 🔥 CLIENT
// =========================
Route::prefix('client')->name('client.')->middleware(['auth'])->group(function () {
    Route::get('/', fn() => view('dashboards.client'))->name('dashboard');
});

// Route pour éviter l'erreur de route non définie
Route::get('dashboards/admin_bureau', function () {
    return view('dashboards.admin_bureau');
})->name('dashboards.admin_bureau');

require __DIR__.'/auth.php';
