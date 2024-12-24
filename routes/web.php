<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TranslateController;
use Illuminate\Support\Facades\Route;
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
    return view('welcome');
});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/translate', [TranslateController::class, 'index'])->name('translate.index');
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
Route::group(['prefix'=>'room'],function() {
    Route::get('/', [RoomController::class,'index'])->name('room.index');
    Route::get('/detail/{id}', [RoomController::class,'detail'])->name('room.detail');
    Route::post('/create', [RoomController::class,'createRoom'])->name('room.create');
    Route::get('/delete/{id}', [RoomController::class,'destroy'])->name('room.destroy');
});

