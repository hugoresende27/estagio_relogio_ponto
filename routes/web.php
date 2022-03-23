<?php

use Illuminate\Support\Facades\Auth;

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




Auth::routes();

Route::get('/', function () {
    // return view('backend.home');
    return view('backend.welcome');
});




// Route::post('login', [AuthController::class,'login']);



Route::group(['middleware'=>['auth:sanctum']], function () {


    Route::get('logoutweb', [AuthController::class,'logoutweb'])->name('logoutweb');

//////////////////////////ADMIN ROUTES////////////////////////////////////////////////////////////////
    Route::resource('/admin', AdminController::class);

/////////////////////EMPLOYEE ROUTES////////////////////////////////////////////////////////////////
    Route::resource('/employees', EmployeeController::class);


});









