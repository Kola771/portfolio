<?php

use App\Http\Controllers\BibliographyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Admin/Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/competences', function () {
    return Inertia::render('Competences');
})->name('competences');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/myprojects', [ProjectController::class, 'index'])->name("projects");
Route::get('/addproject', [ProjectController::class, 'addVue'])->name("addVue")->middleware(['auth', 'verified']);

Route::get('/allProject', [ProjectController::class, 'allProject'])->name("allProject")->middleware('auth');
Route::get('/allProjectLimit', [ProjectController::class, 'allProjectLimit'])->name("allProjectLimit")->middleware('auth');
Route::get('project/edit/{id}', [ProjectController::class, 'edit'])->name("edit.project")->middleware('auth');
Route::post('project/update/{id}', [ProjectController::class, "update"])->name('project.update')->middleware('auth');
Route::post('/createproject', [ProjectController::class, 'store'])->name("project.store")->middleware('auth');
Route::post('/deleteproject', [ProjectController::class, 'destroy'])->name("project.delete")->middleware('auth');
Route::post('/searchProject', [ProjectController::class, 'searchProject'])->name("project.searchProject")->middleware('auth');

Route::get('/bibliography', [BibliographyController::class, 'bibliography'])->name("bibliographie.bibliography");
Route::get('/editBibliography', [BibliographyController::class, 'index'])->name("bibliographie.editBibliography")->middleware('auth');
Route::post('bibliographie/update/{id}', [BibliographyController::class, "update"])->name('bibliographie.update')->middleware('auth');

Route::get('/contacts', [ContactController::class, 'index'])->name("contacts");
Route::get('contacts/vueIndex', [ContactController::class, 'vueIndex'])->name("vueContacts");
Route::post('contacts/oneContact', [ContactController::class, 'oneContact'])->name("oneContact");
Route::get('/allContacts', [ContactController::class, 'allContact'])->name("allContact");
Route::post('/addContacts', [ContactController::class, 'store'])->name("addContact");

require __DIR__.'/auth.php';
