<?php


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Validation\ValidationException;
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

    ////////////teste frontend///////////
    Route::get('user', [AuthController::class,'me']);


    Route::post('logout', [AuthController::class,'logout']);

//////////////////////////ADMIN ROUTES////////////////////////////////////////////////////////////////
    Route::resource('/admin', AdminController::class);
  



/////////////////////COMPANY ROUTES///////////////////////////////////////////////////////////////////
    Route::resource('/companies', CompanyController::class);
    Route::get('/companies/{id}/showemployees', [CompanyController::class, 'showEmployees']);
    Route::get('/companies/{id}/showdepartments',[CompanyController::class, 'showDepartments']);
    Route::get('companiesexportexcel/', [CompanyController::class, 'export_xlsx']);
    Route::get('companiesexportcsv/', [CompanyController::class, 'export_csv']);
    Route::post('companiesimport/', [CompanyController::class, 'import']);

/////////////////////DEPARMENT ROUTES////////////////////////////////////////////////////////////////
    Route::resource('/departments', DepartmentController::class);
    Route::post('/departments/{id}/showemployees', [DepartmentController::class, 'showEmployees']);
    

/////////////////////EMPLOYEE ROUTES////////////////////////////////////////////////////////////////
    Route::resource('/employees', EmployeeController::class);
    Route::get('/employeessearch', [EmployeeController::class, 'search']);
       
    Route::get('employeesexportexcel/', [EmployeeController::class, 'export_xlsx']);
    Route::get('employeesexportcsv/', [EmployeeController::class, 'export_csv']);
    Route::post('employeesimport/', [EmployeeController::class, 'import']);


/////////////////////LOCATIONS ROUTES////////////////////////////////////////////////////////////////
    Route::resource('/locations', LocationController::class);
    Route::get('locationsexportexcel/', [LocationController::class, 'export_xlsx']);
    Route::get('locationsexportcsv/', [LocationController::class, 'export_csv']);
    Route::post('locationsimport/', [LocationController::class, 'import']);

/////////////////////SCHEDULES ROUTES////////////////////////////////////////////////////////////////
    Route::resource('/schedules', ScheduleController::class);



/////////////////////CLOCKPOINT ROUTES////////////////////////////////////////////////////////////////
    Route::resource('/clockpointentry', ClockpointentryController::class);
    Route::get('clockpointentrysexportexcel/', [ClockpointentryController::class, 'export_xlsx']);
    Route::get('clockpointentrysexportcsv/', [ClockpointentryController::class, 'export_csv']);
    Route::post('clockpointentrysimport/', [ClockpointentryController::class, 'import']);




//////////////////////////SEARCH ROUTES////////////////////////////////////////////////////////////////
    Route::get('search', [SearchController::class, 'search']);

/////////////////////FILES ROUTES////////////////////////////////////////////////////////////////
    Route::resource('files', FileController::class);
   
/////////////////////IMAGES ROUTES////////////////////////////////////////////////////////////////
    Route::resource('images', ImageController::class);
    

});

