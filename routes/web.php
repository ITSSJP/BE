<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonController;
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
    Route::post('/{id}/add-member', [RoomController::class, 'addStudentToRoom'])->name('add.member');
    Route::get('/{id}/members', [RoomController::class, 'getRoomMembers'])->name('getMember');
    Route::delete('/{id}/members/delete/{memberId}', [RoomController::class, 'deleteMember'])->name('member.destroy');
    Route::group(['prefix'=>'/{id}/lesson'],function() {
        Route::get('/create', [LessonController::class,'create'])->name('lesson.create');
        Route::post('/create', [LessonController::class,'store'])->name('lesson.store');
        Route::get('/list-lesson', [LessonController::class,'getFlashCardPackages'])->name('lesson.list');
        Route::get('/lesson-detail/{lessonId}', [LessonController::class,'showLesson'])->name('lesson.detail');
        Route::get('/get-flashcard-item/{lessonId}', [LessonController::class,'getFlashCardItems'])->name('lesson.getFlashCardItem');
        Route::get('/quiz/{lessonId}', [LessonController::class, 'generateQuiz'])->name('quiz.create');
        Route::get('/test/{lessonId}', [LessonController::class, 'createTest'])->name('test.create');

    });


});
Route::get('/search-users', [RoomController::class, 'searchUser'])->name('search.user');

