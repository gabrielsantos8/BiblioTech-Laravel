<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('/admin/login', [UserController::class, 'login']);
Route::post('/admin/create', [UserController::class, 'create']);
Route::post('/admin/update', [UserController::class, 'update']);
Route::post('/admin/destroy', [UserController::class, 'destroy']);
