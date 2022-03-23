<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DepartmentController;

use App\Http\Controllers\backoffice\FileBackofficeController;
use App\Http\Controllers\backoffice\CompanyBackofficeController;
use App\Http\Controllers\backoffice\EmployeeBackofficeController;
use App\Http\Controllers\backoffice\LocationBackofficeController;
use App\Http\Controllers\backoffice\ScheduleBackofficeController;
use App\Http\Controllers\backoffice\DepartmentBackofficeController;



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
    return view('backoffice.welcome');
});

Route::get('logout', function () {
    Auth::guard('web')->logout();
    return view ('backoffice.welcome');
});



Route::group(['middleware'=>['auth:sanctum']], function () {



//////////////////////////ADMIN ROUTES////////////////////////////////////////////////////////////////
    Route::resource('/admin', AdminController::class);

/////////////////////EMPLOYEE ROUTES////////////////////////////////////////////////////////////////
    Route::resource('/employees', EmployeeBackofficeController::class);

/////////////////////COMPANY ROUTES///////////////////////////////////////////////////////////////////
    Route::resource('/companies', CompanyBackofficeController::class);
/////////////////////DEPARMENT ROUTES////////////////////////////////////////////////////////////////
    Route::resource('/departments', DepartmentBackofficeController::class);
/////////////////////LOCATIONS ROUTES////////////////////////////////////////////////////////////////
    Route::resource('/locations', LocationBackofficeController::class);
/////////////////////SCHEDULES ROUTES////////////////////////////////////////////////////////////////
    Route::resource('/schedules', ScheduleBackofficeController::class);
/////////////////////FILES ROUTES////////////////////////////////////////////////////////////////
    Route::resource('files', FileBackofficeController::class);
});









