<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

// Route::get('/', [App\Http\Controllers\AuthController::class, 'login']);

// Route::get('login', [AuthController::class, 'index_web']);

// Route::get('employeesexportexcel/', [EmployeeController::class, 'export_xlsx']);
// Route::get('employeesexportcsv/', [EmployeeController::class, 'export_csv']);

// Route::get('companiesexportexcel/', [CompanyController::class, 'export_xlsx']);
// Route::get('companiesexportcsv/', [CompanyController::class, 'export_csv']);


