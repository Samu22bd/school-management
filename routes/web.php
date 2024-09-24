<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

get -> ambil data
post -> nulis data (ke database)
put -> update data
patch -> update data
delete -> hapus data
options -> 
*/

// Route::get('/', function () {
//     return view('home', [
//         'name' => 'Samuel', 
//         'role' => 'te',
//         'buah' => ['pisang', 'semangka', 'jeruk', 'nanas', 'kiwi']
//     ]);
// });

Route::get('/', function () {
    return view('home');
})->middleware('auth');

// urus middleware itu di kernel.php, ini middleware('auth'),('guest') merupakan routed middleware

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticating'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Arahkan ke class 'StudentController' dengan function 'index'
Route::get('/students', [StudentController::class,'index'])->middleware('auth');
// Route::get('/students', [StudentController::class,'index']);

// Route::get('/student/{id}', [StudentController::class,'show']);
// Route::get('/student-add', [StudentController::class,'create']);
// Route::post('/student', [StudentController::class, 'store']);
// Route::get('/student-edit/{id}', [StudentController::class, 'edit']);
// Route::put('/student/{id}', [StudentController::class, 'update']);

Route::get('/student/{id}', [StudentController::class,'show'])->middleware('auth','AdminOrTeacherOnly');
Route::get('/student-add', [StudentController::class,'create'])->middleware('auth','AdminOrTeacherOnly');
Route::post('/student', [StudentController::class, 'store'])->middleware('auth','AdminOrTeacherOnly');
Route::get('/student-edit/{id}', [StudentController::class, 'edit'])->middleware('auth','AdminOrTeacherOnly');
Route::put('/student/{id}', [StudentController::class, 'update'])->middleware('auth','AdminOrTeacherOnly');

// Route::get('/student-delete/{id}', [StudentController::class, 'delete']);
// Route::delete('/student-destroy/{id}', [StudentController::class, 'destroy']);
// Route::get('/student-deleted', [StudentController::class,'deletedStudent']);
// Route::get('/student/{id}/restore', [StudentController::class, 'restore']);

Route::get('/student-delete/{id}', [StudentController::class, 'delete'])->middleware('auth','AdminOnly');
Route::delete('/student-destroy/{id}', [StudentController::class, 'destroy'])->middleware('auth','AdminOnly');
Route::get('/student-deleted', [StudentController::class,'deletedStudent'])->middleware('auth','AdminOnly');
Route::get('/student/{id}/restore', [StudentController::class, 'restore'])->middleware('auth','AdminOnly');

Route::get('/classroom', [ClassController::class,'index']);
Route::get('/class/{id}', [ClassController::class,'show']);

Route::get('/extracurricular', [ExtracurricularController::class,'index']);
Route::get('/extracurricular-detail/{id}', [ExtracurricularController::class,'show']);

Route::get('/teacher', [TeacherController::class,'index']);
Route::get('/teacher-detail/{id}', [TeacherController::class,'show']);
