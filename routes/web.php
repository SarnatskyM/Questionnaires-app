<?php

use App\Http\Controllers\RespondentController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;


Route::get('/test/{slug}', [TestController::class, 'show']);

// Route::get('/tests', [TestController::class, 'index'])->name('tests.index'); 
// Route::get('/test/{test}', [TestController::class, 'show'])->name('test.show');
Route::post('/test/{test}/submit', [TestController::class, 'submit'])->name('test.submit');
Route::get('/success', [TestController::class, 'success'])->name('test.success');
Route::get('/export', [RespondentController::class, 'export'])->name('test.export');

