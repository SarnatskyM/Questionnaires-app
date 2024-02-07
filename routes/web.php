<?php

use App\Http\Controllers\RespondentController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

// Маршрут для отображения формы регистрации респондента
Route::get('/register', [RespondentController::class, 'showRegistrationForm'])->name('registration.form');
Route::post('/register',[RespondentController::class, 'register'])->name('registration.submit');

// Маршруты для работы с тестами
Route::get('/tests', [TestController::class, 'index'])->name('tests.index'); 
Route::get('/test/{test}', [TestController::class, 'show'])->name('test.show'); 
Route::post('/test/{test}/submit',[TestController::class, 'submit'])->name('test.submit');
