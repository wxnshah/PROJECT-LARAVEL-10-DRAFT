<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRUDController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;

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
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('logout', [LogoutController::class, '__invoke'])->name('logout');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('login.check');

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');

Route::middleware(['auth'])->group(function () {
    Route::get('senarai_data', [CRUDController::class, 'paparSenaraiData'])->name('senarai_data');

    Route::get('tambah_data', [CRUDController::class, 'paparTambahData'])->name('tambah_data');
    Route::post('tambah_data', [CRUDController::class, 'store'])->name('data.store');
    
    Route::get('kemaskini_data/{id_data}/edit', [CRUDController::class, 'paparKemaskiniData'])->name('data.edit');
    Route::patch('kemaskini_data/{id_data}/edit', [CRUDController::class, 'kemaskiniData'])->name('data.update');
    Route::get('kemaskini_data/{id_data}/delete', [CRUDController::class, 'deleteData'])->name('data.delete');
});
