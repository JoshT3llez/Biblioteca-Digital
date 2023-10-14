<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortafolioController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\EmployeeController; //add the ControllerNameSpace
use App\Http\Controllers\AuthController;

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
    return view('login');
});

Route::resource("/portafolio", PortafolioController::class)->middleware('auth');
Route::delete('portafolio/{id}', [PortafolioController::class, 'destroy'])->name('portafolio.destroy')->middleware('auth');
route::get('welcome/{id}', [WelcomeController::class, 'views'])->name('employee.views')->middleware('auth');
Route::resource("/employee", EmployeeController::class)->middleware('auth');

route::get('/portafolio', [PortafolioController::class, 'index'])->name('portafolio.index')->middleware('auth');
route::get('/', [PortafolioController::class, 'index'])->name('welcome.index')->middleware('auth');


Route::view('portafolio/fonfo', 'fonfo');


Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('auth');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register')->middleware('auth');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/register', [AuthController::class, 'register']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});
