<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\RiderController;
use App\Http\Controllers\Admin\UserController;

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

Auth::routes();

  

Route::get('/', [HomeController::class, 'adminLoginForm']);

Route::resource('categoriess', App\Http\Controllers\CategoryController::class);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth', 'role:superadministrator']], function(){
    Route::get('/dashboard', [AdminController::class, 'index'])->name('/dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('riders', RiderController::class);
    Route::resource('users', UserController::class);
    Route::get('branch_products/{id}', [BranchController::class, 'branch_products']);
});