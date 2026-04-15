<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| AUTH DASHBOARD (ROLE REDIRECT)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = auth()->user();

    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'chef_projet' => redirect()->route('chef.dashboard'),
        'rh' => redirect()->route('rh.dashboard'),
        'comptable' => redirect()->route('comptable.dashboard'),
        default => redirect()->route('pending'),
    };
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| PENDING PAGE
|--------------------------------------------------------------------------
*/
Route::get('/pending', function () {
    return view('pending');
})->middleware('auth')->name('pending');

/*
|--------------------------------------------------------------------------
| PROFILE (ALL USERS)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| EMPLOYE AREA
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Employe\EmpDashboardController;
use App\Http\Controllers\Employe\TacheController;
use App\Http\Controllers\Employe\AbsenceController as EmployeAbsence;
use App\Http\Controllers\Employe\SalaireController as EmployeSalaire;

Route::middleware(['auth'])->prefix('employe')->name('employe.')->group(function () {

    Route::get('/dashboard', [EmpDashboardController::class, 'index'])->name('dashboard');

    Route::get('/taches', [TacheController::class, 'index'])->name('taches.index');
    Route::get('/taches/{id}', [TacheController::class, 'show'])->name('taches.show');
    Route::patch('/taches/{id}/status', [TacheController::class, 'updateStatus'])->name('taches.updateStatus');

    Route::get('/absences', [EmployeAbsence::class, 'index'])->name('absences.index');
    Route::post('/absences', [EmployeAbsence::class, 'store'])->name('absences.store');

    Route::get('/mes-salaires', [EmployeSalaire::class, 'index'])->name('salaires.index');
});

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProduitController;
use App\Http\Controllers\Admin\ProjetController;
use App\Http\Controllers\Admin\DepartementController;

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('users', UserController::class);
        Route::patch('/users/{id}/update', [UserController::class, 'updateFull'])->name('users.updateFull');

        Route::resource('departements', DepartementController::class);

        Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
        Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');

        Route::get('/projets', [ProjetController::class, 'index'])->name('projets.index');
        Route::post('/projets', [ProjetController::class, 'store'])->name('projets.store');
        Route::delete('/projets/{projet}', [ProjetController::class, 'destroy'])->name('projets.destroy');
        Route::get('/projets/{projet}/edit', [ProjetController::class, 'edit'])->name('projets.edit');
        Route::put('/projets/{projet}', [ProjetController::class, 'update'])->name('projets.update');
    });

/*
|--------------------------------------------------------------------------
| CHEF PROJET AREA
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Chef\ProjetController as ChefProjetController;
use App\Http\Controllers\Chef\ProjetDetailsController;

Route::middleware(['auth', 'role:chef'])
    ->prefix('chef')
    ->name('chef.')
    ->group(function () {

        Route::get('/dashboard', [ChefProjetController::class, 'dashboard'])->name('dashboard');

        Route::resource('projets', ChefProjetController::class);

        Route::get('/projets/{id}', [ProjetDetailsController::class, 'show'])->name('projets.show');

        Route::post('/projets/{id}/add-membre', [ProjetDetailsController::class, 'addMembre'])->name('projets.addMembre');

        Route::post('/taches', [ProjetDetailsController::class, 'storeTache'])->name('taches.store');
        Route::delete('/taches/{id}', [ProjetDetailsController::class, 'destroyTache'])->name('taches.destroy');
    });

/*
|--------------------------------------------------------------------------
| RH AREA
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\RH\EmployeController;
use App\Http\Controllers\RH\SalaireController;
use App\Http\Controllers\RH\AbsenceController as RHAbsenceController;
use App\Http\Controllers\RH\DashboardController as RHDashboard;

Route::middleware(['auth', 'role:rh'])
    ->prefix('rh')
    ->name('rh.')
    ->group(function () {

        Route::get('/dashboard', [RHDashboard::class, 'index'])->name('dashboard');

        Route::get('/employes', [EmployeController::class, 'index'])->name('employes.index');

        Route::get('/absences', [RHAbsenceController::class, 'index'])->name('absences.index');
        Route::patch('/absences/{absence}', [RHAbsenceController::class, 'updateStatus'])->name('absences.update');

        Route::post('/salaires/prime', [SalaireController::class, 'storePrime'])->name('salaires.store-prime');
        Route::post('/salaires/store-complet', [SalaireController::class, 'storeComplet'])->name('salaires.store-complet');
    });

/*
|--------------------------------------------------------------------------
| COMPTABLE AREA
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Comptable\DashboardController as ComptableDashboard;
use App\Http\Controllers\Comptable\SalaireController as ComptableSalaire;

Route::middleware(['auth', 'role:comptable'])
    ->prefix('comptable')
    ->name('comptable.')
    ->group(function () {

        Route::get('/dashboard', [ComptableDashboard::class, 'index'])->name('dashboard');

        Route::get('/salaires', [ComptableSalaire::class, 'index'])->name('salaires.index');

        Route::post('/salaires/payer/{id}', [ComptableSalaire::class, 'validerPaiement'])->name('salaires.payer');
    });
