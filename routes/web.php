<?php

require __DIR__.'/auth.php';

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employe\EmpDashboardController;
use App\Http\Controllers\Employe\TacheController;
use App\Http\Controllers\Employe\AbsenceController as EmployeAbsence;
use App\Http\Controllers\Employe\SalaireController as EmployeSalaire;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProduitController;
use App\Http\Controllers\Admin\ProjetController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartementController;
use App\Http\Controllers\Chef\ProjetController as ChefProjetController;
use App\Http\Controllers\Chef\ProjetDetailsController;
use App\Http\Controllers\RH\EmployeController;
use App\Http\Controllers\RH\SalaireController;
use App\Http\Controllers\RH\dashboardController as rhDashboard;
use App\Http\Controllers\Comptable\DashboardController as dashboardComptable;
use App\Http\Controllers\Comptable\SalaireController as ComptableSalaire;
use App\Http\Controllers\RH\AbsenceController;
Route::get('/', function () {
    return view('welcome');
});
;
Route::middleware(['auth', 'role:employe|rh|admin|comptable|chef_projet'])
    ->prefix('employe')
    ->name('employe.')
    ->group(function () {

        Route::get('/dashboard', [EmpDashboardController::class, 'index'])->name('dashboard');

        Route::get('/taches', [TacheController::class, 'index'])->name('taches.index');
        Route::get('/taches/{id}', [TacheController::class, 'show'])->name('taches.show');
        Route::patch('/taches/{id}/status', [TacheController::class, 'updateStatus'])->name('taches.updateStatus');

        Route::get('/absences', [EmployeAbsence::class, 'index'])->name('absences.index');
        Route::post('/absences', [EmployeAbsence::class, 'store'])->name('absences.store');

        Route::get('/mes-salaires', [EmployeSalaire::class, 'index'])->name('salaires.index');
});

Route::get('/pending', function () {
    return view('pending');
})->middleware('auth')->name('pending');

Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role === 'chef_projet') {
        return redirect()->route('chef.dashboard');
    }

     if ($user->role === 'rh') {
        return redirect()->route('rh.dashboard');
    }
    return redirect()->route('pending');
})->middleware(['auth'])->name('dashboard');

Route::get('/pending', function () {
    return view('pending');
})->middleware('auth')->name('pending');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Route::middleware(['auth' , 'role:admin'])->group(function () {
//     Route::get('/users', [UserController::class, 'index'])->name('users.index');
//     Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
// });





Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
    Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');
    Route::get('/projets', [ProjetController::class, 'index'])->name('projets.index');
    Route::post('/projets', [ProjetController::class, 'store'])->name('projets.store');
    Route::resource('users', UserController::class);
    Route::resource('departements', DepartementController::class);
    Route::patch('/admin/users/{id}/update', [UserController::class, 'updateFull'])->name('users.updateFull');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
    //////////////////////////////////
    Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
    Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');
    Route::get('/projets', [ProjetController::class, 'index'])->name('projets.index');
    Route::post('/projets', [ProjetController::class, 'store'])->name('projets.store');
    Route::delete('/projets/{projet}', [ProjetController::class, 'destroy'])->name('projets.destroy');
    Route::get('/projets/{projet}/edit', [ProjetController::class, 'edit'])->name('projets.edit');
    Route::put('/projets/{projet}', [ProjetController::class, 'update'])->name('projets.update');
});



Route::middleware(['auth', 'role:chef_projet'])->prefix('chef')->name('chef.')->group(function () {
    Route::get('/dashboard', [ChefProjetController::class, 'dashboard'])->name('dashboard');
    Route::get('/projets', [ChefProjetController::class, 'index'])->name('projets.index');
    Route::get('/projets/{id}', [ProjetDetailsController::class, 'show'])->name('projets.show');
    Route::post('/chef/projets/{id}/add-membre', [ProjetDetailsController::class, 'addMembre'])->name('projets.addMembre');
    Route::delete('/taches/{id}', [ProjetDetailsController::class, 'destroyTache'])->name('taches.destroy');
    Route::post('/taches', [ProjetDetailsController::class, 'storeTache'])->name('taches.store');
    Route::resource('projets', ChefProjetController::class);
});

Route::middleware(['auth', 'role:rh'])->prefix('rh')->name('rh.')->group(function () {

    Route::get('/dashboard', [rhDashboard::class, 'index'])->name('dashboard');
    Route::get('/absences', [AbsenceController::class, 'index'])->name('absences.index');
    Route::patch('/absences/{absence}', [AbsenceController::class, 'updateStatus'])->name('absences.update');
    Route::get('/employes', [EmployeController::class, 'index'])->name('employes.index');
    Route::post('/salaires/prime', [SalaireController::class, 'storePrime'])->name('salaires.store-prime');
    Route::post('/salaires/store-complet', [SalaireController::class, 'storeComplet'])->name('salaires.store-complet');
    Route::get('/absences', [AbsenceController::class, 'index'])->name('absences.index');
});




Route::middleware(['auth', 'role:comptable'])->prefix('comptable')->name('comptable.')->group(function () {

    Route::get('/dashboard', [dashboardComptable::class, 'index'])->name('dashboard');
    Route::get('/salaires', [ComptableSalaire::class, 'index'])->name('salaires.index');
    Route::post('/salaires/payer/{id}', [ComptableSalaire::class, 'validerPaiement'])->name('salaires.payer');
});
