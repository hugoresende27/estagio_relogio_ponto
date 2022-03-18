<?php


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ClockpointentryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [AuthController::class,'register']);

Route::post('login', [AuthController::class,'login']);



Route::group(['middleware'=>['auth:sanctum']], function () {


    Route::post('logout', [AuthController::class,'logout']);

    Route::resource('/companies', CompanyController::class);
    Route::post('/companies/{id}/showemployees', [CompanyController::class, 'showEmployees']);
    Route::post('/companies/{id}/showdepartments',[CompanyController::class, 'showDepartments']);

    Route::resource('/departments', DepartmentController::class);
    Route::post('/departments/{id}/showemployees', [DepartmentController::class, 'showEmployees']);
    

    Route::resource('/employees', EmployeeController::class);
   

    Route::resource('/locations', LocationController::class);

    Route::resource('/schedules', ScheduleController::class);

    Route::resource('/clockpointentry', ClockpointentryController::class);

    Route::resource('/admin', AdminController::class);

});

