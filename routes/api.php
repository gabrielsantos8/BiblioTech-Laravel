<?php

use App\Http\Controllers\CursoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/admin/login', [UserController::class, 'login']);
Route::post('/admin/store', [UserController::class, 'store']);
Route::post('/admin/update', [UserController::class, 'update']);
Route::post('/admin/destroy', [UserController::class, 'destroy']);

Route::post('/curso/store', [CursoController::class, 'store']);