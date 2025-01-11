<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ParametreController;
use App\Http\Controllers\AdminController;


// Routes accessibles à tous
Route::get('/', [AccueilController::class, 'index'])->name('accueil');
Route::get('/films', [AccueilController::class, 'listeFilms'])->name('films');
Route::get('/contact', [AccueilController::class, 'contact'])->name('contact');
route::get('/film/{id}', [AccueilController::class, 'show'])->name('film.show');
Route::get('/catalogue', [AccueilController::class, 'catalogue'])->name('catalogue');
Route::get('/planning', [AccueilController::class, 'showPlanning'])->name('planning');

Route::get('/inscription', [InscriptionController::class, 'showForm'])->name('inscription.form');
Route::post('/inscription', [InscriptionController::class, 'handleForm'])->name('inscription');

Route::get('/connexion', [LoginController::class, 'showLoginForm'])->name('connexion');
Route::post('/connexion', [LoginController::class, 'login'])->name('connexion.submit');

Route::get('/paramètre', [ParametreController::class, 'index'])->name('parametres')->middleware('auth');
Route::post('/dashboard-producteur', [ParametreController::class, 'store1'])->name('producteur.store');
Route::get('movies/{id}/edit', [ParametreController::class, 'edit1'])->name('movies.edit');
Route::put('movies/{id}', [ParametreController::class, 'update1'])->name('movies.update');
Route::delete('movies/{id}', [ParametreController::class, 'destroy1'])->name('movies.destroy');
Route::post('/schedule', [ParametreController::class, 'store2'])->name('technicien.store');
Route::post('/dashboard-technicien/{id}/update', [ParametreController::class, 'update2'])->name('technicien.update');
Route::delete('/dashboard-technicien/{id}/delete', [ParametreController::class, 'destroy2'])->name('technicien.destroy');
Route::get('/dashboard-technicien/{id}/edit', [ParametreController::class, 'edit2'])->name('technicien.edit');

Route::get('/parametre', [AdminController::class, 'index'])->name('admin.parametre');
Route::post('/admin/store-user', [AdminController::class, 'store'])->name('admin.store-user');
Route::put('/admin/update-user/{id}', [AdminController::class, 'update'])->name('admin.update-user');
Route::delete('/admin/delete-user/{id}', [AdminController::class, 'destroy'])->name('admin.delete-user');

