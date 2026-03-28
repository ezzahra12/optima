<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\UserController;
Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
});

use App\Http\Controllers\ProduitController;

Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');

use App\Http\Controllers\ProjetController;

Route::get('/projets', [ProjetController::class, 'index'])->name('projets.index');

Route::post('/projets', [ProjetController::class, 'store'])->name('projets.store');
Route::delete('/projets/{projet}', [ProjetController::class, 'destroy'])->name('projets.destroy');

Route::get('/projets/{projet}/edit', [ProjetController::class, 'edit'])->name('projets.edit');

Route::put('/projets/{projet}', [ProjetController::class, 'update'])->name('projets.update');

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartementController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('adminDashboard');


Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
    Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');

    Route::get('/projets', [ProjetController::class, 'index'])->name('projets.index');
    Route::post('/projets', [ProjetController::class, 'store'])->name('projets.store');
    Route::resource('users', UserController::class);
    Route::resource('departements', DepartementController::class);
});


