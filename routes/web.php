<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Web\TaskWebController;
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
//
//Route::get('/', function () {
//    return view('home');
//})->name('home');
//
//Route::middleware('guest')->group(function () {
//    Route::get('/register', [RegisterController::class, 'show'])->name('register');
//    Route::post('/register', [RegisterController::class, 'register']);
//
//    Route::get('/login', [LoginController::class, 'show'])->name('login');
//    Route::post('/login', [LoginController::class, 'login']);
//});
//
//Route::middleware('auth')->group(function () {
//
//    Route::get('/welcome', function () {
//        return view('welcome');
//    })->name('welcome');
//
//    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
//
//    Route::get('/tasks', [TaskWebController::class, 'index'])->name('tasks.index');
//    Route::get('/tasks/create', [TaskWebController::class, 'create'])->name('tasks.create');
//    Route::post('/tasks', [TaskWebController::class, 'store'])->name('tasks.store');
//    Route::get('/tasks/{id}/edit', [TaskWebController::class, 'edit'])->name('tasks.edit');
//    Route::put('/tasks/{id}', [TaskWebController::class, 'update'])->name('tasks.update');
//    Route::delete('/tasks/{id}', [TaskWebController::class, 'destroy'])->name('tasks.destroy');
//    Route::put('/tasks/{task}/status', [TaskWebController::class, 'updateStatus'])->name('tasks.update-status');
//
//});


Route::get('/', function () {
    return view('home');
})->name('home');

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('welcome');
    })->name('welcome');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Tasks resource
    Route::resource('tasks', TaskWebController::class)->except(['show']);
    Route::put('/tasks/{task}/status', [TaskWebController::class, 'updateStatus'])
        ->name('tasks.update-status');
});
