<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EspecialidadController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Doctor\ScheduleController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\Api;
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
    return view('Auth.login');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->group(function () {
 // especialidades
 Route::get('/especialidades', [EspecialidadController::class, 'index'])->name('index');
 Route::get('/especialidades/create',[EspecialidadController::class,'create']); // form registro
 Route::get('/especialidades/{especialidad}/edit',[EspecialidadController::class,'edit']);
 Route::post('/especialidades',[EspecialidadController::class,'store']);  //envio del from
 Route::put('/especialidades/{especialidad}',[EspecialidadController::class,'update']);  //envio del from
 Route::delete('/especialidades/{especialidad}',[EspecialidadController::class,'destroy']);  //envio del from

 //doctor
 Route::resource('doctores', DoctorController::class);
 Route::resource('pacientes', PatientController::class);

});
Route::middleware(['auth', 'doctor'])->group(function () {
   // Route::resource('calendario', ScheduleController::class);
     Route::get('/calendario',[ScheduleController::class,'edit']);
     Route::post('/calendario',[ScheduleController::class,'store']);

});
Route::middleware('auth')->group(function () {
  Route::get('/citas/create',[CitaController::class,'create']); // form registro
  Route::post('/citas',[CitaController::class,'store']);
   //json
  Route::get('/citas/especialidades/{especialidad}/doctores',[Api\EspecialidadController::class,'doctores']);
  Route::get('/citas/schedule/hours',[Api\ScheduleController::class,'hours']);
});

