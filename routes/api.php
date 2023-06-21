<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/admin/login', [UserController::class, 'login']);
Route::post('/admin/store', [UserController::class, 'store']);
Route::post('/admin/update', [UserController::class, 'update']);
Route::post('/admin/destroy', [UserController::class, 'destroy']);
Route::get('/admin/list', [UserController::class, 'list']);
Route::get('/admin/show/{id}', [UserController::class, 'show']);


Route::post('/curso/store', [CursoController::class, 'store']);
Route::post('/curso/update', [CursoController::class, 'update']);
Route::post('/curso/destroy', [CursoController::class, 'destroy']);
Route::get('/curso/list', [CursoController::class, 'list']);
Route::get('/curso/show/{id}', [CursoController::class, 'show']);


Route::post('/aluno/store', [AlunoController::class, 'store']);
Route::post('/aluno/update', [AlunoController::class, 'update']);
Route::post('/aluno/destroy', [AlunoController::class, 'destroy']);
Route::get('/aluno/list', [AlunoController::class, 'list']);
Route::get('/aluno/show/{id}', [AlunoController::class, 'show']);
Route::get('/aluno/login/{ra}', [AlunoController::class, 'login']);