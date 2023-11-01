<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




Route::get('home',[AuthController::class,'index']);
Route::get('desbord',[AuthController::class,'desbord'])->middleware('guard');


Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/showRegistrationForm',[AuthController::class,'showRegistrationForm'])->middleware('authCheck');
Route::post('/register',[AuthController::class,'register']);

Route::post('/logout', [AuthController::class, 'logout']);
