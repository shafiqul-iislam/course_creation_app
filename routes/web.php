<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/courses', [CourseController::class, 'index'])->name('courses');
Route::get('/create-courses', [CourseController::class, 'create'])->name('create-courses');
Route::post('/store-courses', [CourseController::class, 'store'])->name('store-courses');
