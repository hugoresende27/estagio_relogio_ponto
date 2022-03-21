<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Backoffice\BackauthController;

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


Route::get('/', [AdminController::class, 'home']);

// Auth::routes();
// Route::post('backend/login', [AdminController::class,'login_web'])->name('login_web');
// Route::post('backend/login', [AuthController::class,'login'])->name('login');

Route::get('companies', [AdminController::class,'companies_index']);

Route::group(['middleware'=>['auth:sanctum']], function () {

    Route::get('backend', [AdminController::class,'home']);
    Route::get('backend/companies', [AdminController::class,'companies_index']);

});




