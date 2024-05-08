<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProgrammingLanguageController;
use App\Http\Controllers\RegisterController;
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

Route::get('/register', [RegisterController::class, 'view']);
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'view']);
Route::post('/register', [LoginController::class, 'login']);

Route::get('/select-language/{userId}', [ProgrammingLanguageController::class, 'view'])->name('select-language-view');
Route::post('/select-language/{userId}', [ProgrammingLanguageController::class, 'selectLanguage'])->name('select-language');

Route::get('/', [HomeController::class, 'view'])->name('home');
