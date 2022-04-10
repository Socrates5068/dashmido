<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DarkModeController;
use App\Http\Livewire\Home;
use App\Http\Livewire\Login;

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

Route::get('dark-mode-switcher2', [DarkModeController::class, 'switch'])->name('dark-mode-switcher2');
Route::get('/', Home::class)->name('home');
Route::get('/login', Login::class)->name('login');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
