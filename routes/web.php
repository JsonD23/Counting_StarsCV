<?php

use App\Http\Controllers\Userprofile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Mail\HireConfirmationMail;
use App\Http\Controllers\InterviewController;
use App\Http\Models\User;
use App\Http\Controllers\VacanciesController;
// Ruta para mostrar el calendario
Route::get('/calendar', [Userprofile::class, 'calendar'])->name('calendar');

// Ruta para almacenar una nueva entrevista
Route::post('/interviews/storeC', [Userprofile::class, 'storeC'])->name('interviews.store');

// Ruta para eliminar una entrevista
Route::delete('/interviews/{id}', [Userprofile::class, 'destroyC'])->name('interviews.destroy');




// Ruta para mostrar todas las vacantes
Route::get('/vacancies', [VacanciesController::class, 'index'])->name('vacancies.index');

// Ruta para mostrar las vacantes en la vista showv.blade.php
Route::get('/vacancies/show', [VacanciesController::class, 'showV'])->name('vacancies.show');

// Ruta para almacenar una nueva vacante
Route::post('/vacancies', [VacanciesController::class, 'storeV'])->name('vacancies.store');

// Ruta para eliminar una vacante
Route::delete('/vacancies/{id}', [VacanciesController::class, 'destroyV'])->name('vacancies.destroy');







Route::get('/',function(){
    return view('home');
});

Route::get('/register', [RegisterController::class, 'create'])
    ->name('register.index');

Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store');


Route::get('/login', [SessionsController::class, 'create'])

    ->name('login.index');

Route::post('/login', [SessionsController::class, 'store'])
    ->name('login.store');

Route::get('/logout', [SessionsController::class, 'destroy'])
   
    ->name('login.destroy');



Route::get('/index', [Userprofile::class, 'index'])->name('index');

Route::get('/user/{id}', [Userprofile::class, 'view'])->name('user.profile.view');
Route::get('/create', [Userprofile::class, 'create'])->name('user.profile.create');
Route::post('/store', [Userprofile::class, 'store'])->name('store');
Route::get('/edit/{id}', [Userprofile::class, 'edit'])->name('edit');
Route::post('/update', [Userprofile::class, 'update'])->name('update');
Route::post('/destroy/{id}', [Userprofile::class, 'destroy'])->name('destroy');
Route::get('/nuevacreacion', [Userprofile::class, 'nuevaCreacion'])->name('user.profile.nueva.creacion');
Route::post('/storenuevacreacion', [Userprofile::class, 'storeNuevaCreacion'])->name('store.nueva.creacion');

// Ruta para la segunda vista del perfil
Route::get('/profile/viewdos/{id}', [Userprofile ::class, 'viewDos'])->name('user.profile.viewdos');
Route::get('/profile/viewset/{id}', [Userprofile ::class, 'viewSet'])->name('user.profile.viewset');


//////////////
Route::get('/filter', [Userprofile::class, 'filter'])->name('user.profile.filter');

////////77
Route::get('/user/profile/calendar', [Userprofile::class, 'calendar'])->name('user.profile.calendar');