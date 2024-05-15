<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgrammingLanguageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserPostController;
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
Route::post('/login', [LoginController::class, 'login']);

Route::get('/select-language/{userId}', [ProgrammingLanguageController::class, 'view'])->name('select-language-view');
Route::post('/select-language/{userId}', [ProgrammingLanguageController::class, 'selectLanguage'])->name('select-language');

Route::get('/', [HomeController::class, 'view'])->name('home');
Route::get('/add-question', [UserPostController::class, 'view'])->name('add-question-view');
Route::post('/add-question', [UserPostController::class, 'addQuestion'])->name('add-question');
Route::get('/post/{postId}', [UserPostController::class, 'detail'])->name('post-detail');
Route::post('/post/{postId}', [UserPostController::class, 'addReply'])->name('post-detail-reply');
Route::post('/like', [UserPostController::class, 'likePost'])->name('like-post');
Route::get('/profile', [ProfileController::class, 'view']);
Route::get('/plans', [SubscriptionController::class, 'view']);
Route::post('/plans', [SubscriptionController::class, 'subscribe']);
Route::get('/edit-profile', [ProfileController::class, 'viewEditProfile']);
Route::post('/edit-profile', [ProfileController::class, 'editProfile']);
Route::get('/edit-post/{postId}', [UserPostController::class, 'viewEditPost'])->name('view-edit-post');
Route::post('/edit-post/{postId}', [UserPostController::class, 'editPost'])->name('edit-post');
Route::post('/delete-post', [UserPostController::class, 'deletePost'])->name('delete-post');
Route::post('/search', [HomeController::class, 'search']);
Route::post('/archive-post', [PostController::class, 'archivePost'])->name('archive-post');
Route::get('/archived-questions', [HomeController::class, 'viewArchivedQuestions']);
Route::get('/my-questions', [HomeController::class, 'viewMyQuestions']);

Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/admin', [HomeController::class, 'viewAdmin']);
