<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\Schedules;
use App\Http\Livewire\Admin\TableTime;
use App\Http\Livewire\Admin\ClockingIn;
use App\Http\Livewire\Admin\Users\Users;
use App\Http\Livewire\Admin\ClokingToday;
use App\Http\Livewire\Admin\Users\Patients;
use App\Http\Livewire\Admin\Users\Positions;
use App\Http\Controllers\Admin\DarkModeController;
use App\Http\Controllers\Admin\ColorSchemeController;
use App\Http\Livewire\Admin\ClokingTomorrow;

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

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');

// routes admin
Route::get('/', Dashboard::class)->name('admin.dashboard');
Route::get('/users', Users::class)->name('admin.users');
Route::get('/pacientes', Patients::class)->name('admin.patients');
Route::get('/users/cargos', Positions::class)->name('admin.positions');
Route::get('/horarios', TableTime::class)->name('admin.table');
Route::get('/horarios_fichaje', Schedules::class)->name('admin.schedule');
Route::get('/horarios/hoy', ClokingToday::class)->name('admin.clokingToday');
Route::get('/horarios/manana', ClokingTomorrow::class)->name('admin.clokingTomorrow');

//routes staff
Route::get('/fichaje', ClockingIn::class)->name('admin.clocking');
