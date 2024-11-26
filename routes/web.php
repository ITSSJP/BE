<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassroomController;

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
// Route API để tạo lớp học
Route::post('/classrooms', [ClassroomController::class, 'createClassroom']);

// Route API để thêm sinh viên vào lớp học
Route::post('/classrooms/{roomId}/students', [ClassroomController::class, 'addStudentToClassroom']);

