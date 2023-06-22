<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\EditoraController;
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


Route::post('/autor/store', [AutorController::class, 'store']);
Route::post('/autor/update', [AutorController::class, 'update']);
Route::post('/autor/destroy', [AutorController::class, 'destroy']);
Route::get('/autor/list', [AutorController::class, 'list']);
Route::get('/autor/show/{id}', [AutorController::class, 'show']);


Route::post('/editora/store', [EditoraController::class, 'store']);
Route::post('/editora/update', [EditoraController::class, 'update']);
Route::post('/editora/destroy', [EditoraController::class, 'destroy']);
Route::get('/editora/list', [EditoraController::class, 'list']);
Route::get('/editora/show/{id}', [EditoraController::class, 'show']);