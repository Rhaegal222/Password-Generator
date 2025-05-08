<?php

use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('index', ['title' => 'Password Generator']); });
Route::get('/password/generate', [PasswordController::class, 'generate'])->name('password.generate');
