<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;



use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\backoffice\FileBackofficeController;
use App\Http\Controllers\backoffice\AdminBackofficeController;
use App\Http\Controllers\backoffice\ImageBackofficeController;
use App\Http\Controllers\backoffice\CompanyBackofficeController;
use App\Http\Controllers\backoffice\EmployeeBackofficeController;
use App\Http\Controllers\backoffice\LocationBackofficeController;
use App\Http\Controllers\backoffice\ScheduleBackofficeController;
use App\Http\Controllers\backoffice\ClockpointBackofficeController;
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

Route::get('registerweb', function () { 
    return view('auth.register');
});



Route::group(['middleware'=>['auth:sanctum']], function () {



//////////////////////////ADMIN ROUTES////////////////////////////////////////////////////////////////
    Route::resource('/admin', AdminBackofficeController::class);
    Route::get('/admin/create', [AdminBackofficeController::class, 'create']);

/////////////////////CLOCKPOINT ROUTES////////////////////////////////////////////////////////////////
    Route::resource('/clockpointentry', ClockpointBackofficeController::class);
    Route::get('/clockpointentry/create', [ClockpointBackofficeController::class, 'create']);
    
/////////////////////EMPLOYEE ROUTES////////////////////////////////////////////////////////////////
    Route::resource('/employees', EmployeeBackofficeController::class);
    Route::get('/employees/create', [EmployeeBackofficeController::class, 'create']);
   

/////////////////////COMPANY ROUTES///////////////////////////////////////////////////////////////////
    Route::resource('/companies', CompanyBackofficeController::class);
    Route::get('/companies/create', [CompanyBackofficeController::class, 'create']);
/////////////////////DEPARMENT ROUTES////////////////////////////////////////////////////////////////
    Route::resource('/departments', DepartmentBackofficeController::class);
    Route::get('/departments/create', [DepartmentBackofficeController::class, 'create']);
/////////////////////LOCATIONS ROUTES////////////////////////////////////////////////////////////////
    Route::resource('/locations', LocationBackofficeController::class);
/////////////////////SCHEDULES ROUTES////////////////////////////////////////////////////////////////
    Route::resource('/schedules', ScheduleBackofficeController::class);
    Route::get('/schedules/create', [ScheduleBackofficeController::class, 'create']);
    Route::get('/addschedule/{code}', [ScheduleBackofficeController::class, 'getDepartments']);
/////////////////////FILES ROUTES////////////////////////////////////////////////////////////////
    Route::resource('/files', FileBackofficeController::class);

/////////////////////IMAGES ROUTES////////////////////////////////////////////////////////////////
    Route::resource('/images', ImageBackofficeController::class);
});









