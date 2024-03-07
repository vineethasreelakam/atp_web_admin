<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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
Route::get('/', [AuthController::class, 'index'])->name('login');

   
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 

//vineetha//

Route::group(['middleware' => ['auth:web']], function() {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::any('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/changePassword', [AuthController::class, 'changePassword'])->name('changePassword');
    Route::post('/password_reset', [AuthController::class, 'password_reset'])->name('password_reset');

    Route::get('admin', [AdminController::class, 'index'])->name('admin');
    Route::get('admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('admin/create', [AdminController::class, 'store'])->name('admin.store');
    Route::delete('admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
    Route::get('admin/status/{id}', [AdminController::class, 'changeStatus'])->name('admin.status');

    Route::get('user', [UserController::class, 'index'])->name('user');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user/create', [UserController::class, 'store'])->name('user.store');
    Route::delete('user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
    Route::get('user/status/{id}', [UserController::class, 'changeStatus'])->name('user.status');



    Route::get('role', [RoleController::class, 'index'])->name('role');
    Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('role/create', [RoleController::class, 'store'])->name('role.store');
    Route::delete('role/delete/{id}', [RoleController::class, 'destroy'])->name('role.delete');

});


//vineetha//
    
   
