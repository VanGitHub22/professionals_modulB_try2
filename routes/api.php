<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CourseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/create-sertificate", [CourseController::class, "createSertificate"]);
Route::post("/check-sertificate", [CourseController::class, "checkSertificate"]);

Route::post("register", [UserController::class, "apiRegister"]);
Route::post("login", [UserController::class, "apiLogin"]);
Route::post("logout", [UserController::class, "apiLogout"]);
Route::get("courses", [CourseController::class, "apiCourses"]);
Route::get("courses/{id}", [LessonController::class, "apiLessons"]);
Route::post("courses/{id}/buy", [OrderController::class, "makeOrder"]);
Route::post("courses/payment-webhook", [OrderController::class, "webhook"]);
Route::post("orders", [OrderController::class, "apiOrders"]);
Route::post("orders/{id}", [OrderController::class, "deleteOrder"]);
