<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChefController;

use App\Http\Controllers\DirecteurController;
use App\Http\Controllers\FiltrageControleur;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UtilisateurController;
use Illuminate\Support\Facades\Route;


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

// E-mail routes
Route::get('/email_verification/{hash}', [UtilisateurController::class, 'verify_email'])->name('email_verification');
Route::get('/email_validation/{user}',[UtilisateurController::class, 'validate_email'])->name('validation_email');

// Password forget
Route::get('/users/password/forget', [UtilisateurController::class, 'password_forget'])->name('password.forget');
Route::post('/users/password/recap', [UtilisateurController::class, 'password_recap'])->name('password.recap');
Route::get('/users/password/verify/{hash}', [UtilisateurController::class, 'verify_password'])->name('password.verify');
Route::post('/users/password/confirm', [UtilisateurController::class, 'confirm_password'])->name('password.confirm');

// Authentication routes
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'authenticate'])->name('auth');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::middleware(['auth'])->group(function () {
    // Controllers routes
    Route::resource('services', ServiceController::class);
    Route::resource('users', UtilisateurController::class); 
    Route::resource('tasks', TaskController::class);
    Route::get('/users/{user}/delete', [UtilisateurController::class, 'delete'] )->name('users.delete');
    Route::get('/tasks/{task}/delete', [TaskController::class, 'delete'] )->name('tasks.delete');
    Route::get('/services/{service}/delete', [ServiceController::class, 'delete'] )->name('services.delete');

    // Chef routes
    Route::get('/tasks/confirmed/chef', [ChefController::class, 'confirmed'])->name('tasks.confirmed');
    Route::get('/tasks/accomplished/chef', [ChefController::class, 'uncomfirmed'])->name('tasks.accomplished');
    Route::get('/tasks/validate/{task}', [ChefController::class, 'valid'])->name('tasks.validate');
    Route::get('/tasks/unvalidate/{task}', [ChefController::class, 'unvalid'])->name('tasks.unvalidate');

    // Directeur routes
    Route::get("list_des_taches",[DirecteurController::class,"index"])->name("/list_des_taches");
    Route::get("détail_de_tache/{task}",[DirecteurController::class,"show"])->name("/détail_de_tache");
    Route::get("difficulites",[DirecteurController::class,"probleme"])->name("/difficulites");
    Route::get('selected-option',[DirecteurController::class,"Recuperer"])->name("selected-option");
    Route::get('/export-pdf', [DirecteurController::class, 'exportPDF'])->name('export-pdf');


    //Filtrage routes
    Route::get("filterFonctionnaire/{idFonctionnaire}",[FiltrageControleur::class,'filterFonctionnaire'])->name("/filterFonctionnaire");
    Route::get("filterService/{idService}",[FiltrageControleur::class,'filterService'])->name("/filterService");
    Route::get("filterDate/{idDate}",[FiltrageControleur::class,"filterDate"])->name("/filterDate");

    // Password reset
    Route::get('/users/password/reinitilize', [UtilisateurController::class, 'password_landed'])->name('password.land');
    Route::post('/users/password/reset', [UtilisateurController::class, 'password_reset'])->name('password.reset');

    //admin tasks archive & valide
    Route::get('/tasks/archive/admin', [ArchiveController::class, 'archived'])->name('tasks.archive');
    Route::get('/tasks/valide/admin', [ArchiveController::class, 'validated'])->name('tasks.valide');

// });



