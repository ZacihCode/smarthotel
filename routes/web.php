<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Livewire\Admin\DashboardComponent;
use App\Livewire\Admin\UserManage;
use App\Livewire\Admin\ReservasiManage;
use App\Livewire\ReservasiComponent;
use App\Livewire\KamarManager;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard', DashboardComponent::class)->name('dashboard');
    Route::get('/user', UserManage::class)->name('user');
    Route::get('/kamar', KamarManager::class)->name('kamar');
    Route::get('/reservasis', ReservasiManage::class)->name('reservasis');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/reservasi', ReservasiComponent::class)->name('reservasi');
});
