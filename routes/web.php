<?php

use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('index', ['title' => 'Password Generator']); });
Route::get('/generate-password', [PasswordController::class, 'generate']);
Route::post('/save-password', [PasswordController::class, 'save']);
Route::get('/export-passwords', [PasswordController::class, 'exportCsv']);
