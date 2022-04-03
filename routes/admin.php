<?php

use App\Http\Livewire\Admin\Users;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Controllers\Admin\DarkModeController;
use App\Http\Controllers\Admin\ColorSchemeController;
use App\Http\Livewire\Admin\RegisterUsers;

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

Route::get('/', Dashboard::class)->name('admin.dashboard');
Route::get('/users', Users::class)->name('admin.users');
Route::get('/users/register', RegisterUsers::class)->name('admin.register');
