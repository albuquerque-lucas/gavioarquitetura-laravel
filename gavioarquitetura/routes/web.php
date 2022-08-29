<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Autenticador;
use Illuminate\Support\Facades\Route;


Route::get('/', function(){
    return redirect()->route('home');
});

Route::get('/home', [PublicController::class, 'index'])->name('home');
Route::get('/quem-somos', [PublicController::class, 'profile'])->name('quem_somos');
Route::get('/contato', [PublicController::class, 'email'])->name('email');
Route::post('/email/store', [MailController::class, 'store'])->name('mail.store');


Route::get('/projetos/{name}/{id}', [PublicController::class, 'projectsByCategory']);
Route::get('/projetos', function (){
        return redirect('/projetos/Residencial/1');
    })->name('projetos');
Route::get('/projeto/{id}', [PublicController::class, 'show'])->name('public.show');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('signin');
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/register', [UsersController::class, 'create'])->name('users.create');
Route::post('/register', [UsersController::class, 'store'])->name('users.store');


Route::get('/admin-projects', [ProjectController::class, 'index'])->name('admin_projects.index');
Route::get('/admin-projects/{name}/{id}', [ProjectController::class, 'categoryIndex'])->name('projectsByCategory');
Route::get('/admin-projects/create', [ProjectController::class, 'create'])->name('admin_projects.create');
Route::post('/admin-projects', [ProjectController::class, 'store'])->name('admin_projects.store');
Route::delete('/admin-projects/{id}', [ProjectController::class, 'destroy'])->name('admin_projects.destroy');
Route::get('/admin-projects/{id}',  [ProjectController::class, 'show'])->name('admin_projects.show');

Route::post('/admin-projects/{id}/editCarousel', [ProjectController::class, 'editCarousel'])->name('edit_carousel');
Route::post('/admin-projects/{id}/editName', [ProjectController::class, 'editName']);
Route::post('/admin-projects/{id}/editArea', [ProjectController::class, 'editArea']);
Route::post('/admin-projects/{id}/editYear', [ProjectController::class, 'editYear']);
Route::post('/admin-projects/{id}/editAddress', [ProjectController::class, 'editAddress']);
Route::post('/admin-projects/{id}/editCover', [ProjectController::class, 'editCover'])->name('image.edit');
Route::post('/admin-projects/{id}/editDescription', [ProjectController::class, 'editDescription']);


Route::post('/images/{id}/add', [ImageController::class, 'store'])->name('images.store');
Route::delete('/images/{id}', [ImageController::class, 'destroy'])->name('images.destroy');

Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
Route::post('/profiles/{id}/editName', [ProfileController::class, 'editName']);
Route::post('/profiles/{id}/editDescription', [ProfileController::class, 'editDescription']);
Route::post('/profiles/{id}/editImage', [ProfileController::class, 'editImage']);

