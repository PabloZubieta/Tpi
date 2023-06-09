<?php

use App\Http\Controllers\LabyrintheController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/login', [UserController::class, 'login'])->name('login');

Route::get('/register', [UserController::class, 'register']);

Route::post('/users', [UserController::class, 'create']);

route::post('/logout', [UserController::class,'logout'])->middleware(Authenticate::class);

route::post('/log',[UserController::class,'log']);

route::get('/creation',[LabyrintheController::class,'editor'])->middleware(Authenticate::class);

route::post('/resolution',[LabyrintheController::class,'escape'])->middleware(Authenticate::class);

route::get('/resolution/{id}',[LabyrintheController::class,'escapeThis',])->middleware(Authenticate::class);

route::get('/historique',[UserController::class,'history'])->middleware(Authenticate::class);

route::post('/check',[LabyrintheController::class,'create']);

route::get('/interface',[LabyrintheController::class,'interface']);
