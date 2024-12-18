<?php

use App\Http\Controllers\TranslateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/translate', [TranslateController::class, 'translate']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('rooms', [RoomController::class, 'createRoom']); // API tạo lớp học
Route::post('rooms/{roomId}/students', [RoomController::class, 'addStudentToRoom']); // API thêm học sinh vào lớp học
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('user', [AuthController::class, 'user']);
Route::delete('rooms/{roomId}/students', [RoomController::class, 'removeStudentFromRoom']); // Xóa người dùng khỏi lớp học
Route::put('rooms/{roomId}', [RoomController::class, 'updateRoomName']); // Thay đổi tên phòng học
Route::delete('rooms/{roomId}', [RoomController::class, 'deleteRoom']); // Hủy phòng học
