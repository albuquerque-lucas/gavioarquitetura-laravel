<?php

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
Route::get('/email', function (){
    return new App\Mail\SendEmail(
      "Lucas Albuquerque",
      'lucaslpra@gmail.com',
      'Orçamento',
      'Oi!'
    );
});
Route::post('/email/store', [MailController::class, 'store'])->name('mail.store');

//Route::get('/projetos', [PublicController::class, 'projects'])->name('projetos');

Route::get('/projetos', function (){
    return redirect('/projetos/Residencial/1');
})->name('projetos');

Route::get('/projetos/{nome}/{id}', [PublicController::class, 'categoryIndex']);
Route::get('/projeto/{id}', [PublicController::class, 'show'])->name('public.show');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('signin');
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/register', [UsersController::class, 'create'])->name('users.create');
Route::post('/register', [UsersController::class, 'store'])->name('users.store');


Route::get('/admin-projetos', [ProjectController::class, 'index'])->name('admin_projetos.index');
Route::get('/admin-projetos/{nome}/{id}', [ProjectController::class, 'categoryIndex'])->name('categoryIndex');

Route::get('/admin-projetos/create', [ProjectController::class, 'create'])->name('admin_projetos.create');
Route::post('/admin-projetos', [ProjectController::class, 'store'])->name('admin_projetos.store');
Route::delete('/admin-projetos/{id}', [ProjectController::class, 'destroy'])->name('admin_projetos.destroy');


Route::post('/admin-projetos/{id}/editaCampoNome', [ProjectController::class, 'editaCampoNome']);
Route::post('/admin-projetos/{id}/editaCampoArea', [ProjectController::class, 'editaCampoArea']);
Route::post('/admin-projetos/{id}/editaCampoAno', [ProjectController::class, 'editaCampoAno']);
Route::post('/admin-projetos/{id}/editaCampoLocalizacao', [ProjectController::class, 'editaCampoLocalizacao']);
Route::post('/admin-projetos/{id}/editaImagemCapa', [ProjectController::class, 'editaImagemCapa']);
Route::post('/admin-projetos/{id}/editaCampoDescricao', [ProjectController::class, 'editaCampoDescricao']);

Route::get('/admin-projetos/{id}',  [ProjectController::class, 'show']);
Route::post('/photos/{id}/individual/adicionarFoto', [ProjectController::class, 'individualFotosStore'])->name('photos.store');
Route::delete('/admin-projetos/individual/excluirFoto/{id}', [ProjectController::class, 'individualFotosDestroy'])->name('photos.destroy');

Route::get('/admin-perfis', [ProfileController::class, 'index'])->name('profiles.index');
Route::post('/admin-projetos/{id}/editaNomePerfil', [ProfileController::class, 'editaNomeProfile']);
Route::post('/admin-projetos/{id}/editaDescricaoPerfil', [ProfileController::class, 'editaDescricaoProfile']);
Route::post('/admin-projetos/{id}/editaImagemProfile', [ProfileController::class, 'editaImagemProfile']);

