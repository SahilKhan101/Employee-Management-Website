<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/',[App\Http\Controllers\MainController::class,'e_profile'])->name('login');
Route::redirect('/', '/login');
Route::redirect('/home', '/employee-dashboard');
Route::redirect('/tasks', '/employee-dashboard');

// Route::get('/profiles',[App\Http\Controllers\MainController::class,'e_profile'])->name('e-profile');
Route::get('/employee-dashboard',[App\Http\Controllers\MainController::class,'e_dashboard'])->name('e-dashboard');
// Route::get('/admin-dashboard',[App\Http\Controllers\MainController::class,'a_dashboard'])->name('a-dashboard');
Route::get('/create-profile',[App\Http\Controllers\ProfilesController::class,'create_profile'])->name('create-profile');


// Route::get('auth/google', [App\Http\Controllers\Auth\GoogleController::class,'redirectToGoogle'])->name('google-login');
// Route::get('auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class,'handleGoogleCallback']);
// Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');



Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'isAdmin'])->group(function () {

    // Route::get('/admin-dashboard', function () {
    //   return view('admin.dashboard');
    // })->name('a-dashboard');

    Route::get('/admin-dashboard',[App\Http\Controllers\MainController::class,'a_dashboard'])->name('a-dashboard');
  });



Route::resource('profiles', 'App\Http\Controllers\ProfilesController');
Route::resource('tasks', 'App\Http\Controllers\TasksController');
Route::resource('users', 'App\Http\Controllers\UserController');


// Route::get('/tasks_dd', 'TaskController@exportCsv');
// Route::get('/tasks',[App\Http\Controllers\MainController::class,'exportCsv'])->name('tasks-export');
Route::get('/user_export', [\App\Http\Controllers\MainController::class, 'user_export'])->name('user_export');
Route::get('/task_export', [\App\Http\Controllers\MainController::class, 'task_export'])->name('task_export');
