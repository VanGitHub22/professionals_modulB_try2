<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;

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

Route::get('/register', [UserController::class, "regForm"]);
Route::post('/register', [UserController::class, "register"]);
Route::get('/login', [UserController::class, "logForm"]);
Route::post('/login', [UserController::class, "login"]);
Route::get('/logout', [UserController::class, "logout"]);

Route::get('/courses', [CourseController::class, "index"]);


Route::get('/admin', [CourseController::class, "indexAdmin"])->middleware("can:is_admin,App\Models\User");
Route::post('/admin', [CourseController::class, "addAdmin"])->middleware("can:is_admin,App\Models\User");
Route::patch('/admin', [CourseController::class, "editAdmin"])->middleware("can:is_admin,App\Models\User");
Route::delete('/admin', [CourseController::class, "deleteAdmin"])->middleware("can:is_admin,App\Models\User");

Route::get('/adminLesson', [LessonController::class, "indexAdmin"])->middleware("can:is_admin,App\Models\User");
Route::post('/adminLesson', [LessonController::class, "addAdmin"])->middleware("can:is_admin,App\Models\User");
Route::patch('/adminLesson', [LessonController::class, "editAdmin"])->middleware("can:is_admin,App\Models\User");
Route::delete('/adminLesson', [LessonController::class, "deleteAdmin"])->middleware("can:is_admin,App\Models\User");
