<?php



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class,'register']);

Route::post('login', [AuthController::class,'login']);

Route::group(['middleware'=>['auth:sanctum']], function () {


    Route::post('logout', [AuthController::class,'logout']);


    
    /////EMPRESAS //////////////////////////////////////////////////////////////////////
    Route::get('empresas', 'App\Http\Controllers\EmpresaController@getEmpresas');

    Route::get('empresas/{id}', 'App\Http\Controllers\EmpresaController@getEmpresasById');

    Route::post('addempresas', 'App\Http\Controllers\EmpresaController@addEmpresas');

    Route::put('updateempresas/{id}', 'App\Http\Controllers\EmpresaController@updateEmpresas');

    Route::delete('deleteempresas/{id}', 'App\Http\Controllers\EmpresaController@deleteEmpresas');

    


    /////DEPARTAMENTOS //////////////////////////////////////////////////////////////////////
    Route::get('departamentos', 'App\Http\Controllers\DepartamentoController@getDepartamentos');

    Route::get('departamentos/{id}', 'App\Http\Controllers\DepartamentoController@getDepartamentosById');

    Route::post('adddepartamentos', 'App\Http\Controllers\DepartamentoController@addDepartamentos');

    Route::put('updatedepartamentos/{id}', 'App\Http\Controllers\DepartamentoController@updateDepartamentos');

    Route::delete('deletedepartamentos/{id}', 'App\Http\Controllers\DepartamentoController@deleteDepartamentos');



    /////FUNCIONARIOS //////////////////////////////////////////////////////////////////////
    Route::get('funcionarios', 'App\Http\Controllers\FuncionarioController@getFuncionarios');

    Route::get('funcionarios/{id}', 'App\Http\Controllers\FuncionarioController@getFuncionariosById');

    Route::post('addfuncionarios', 'App\Http\Controllers\FuncionarioController@addFuncionarios');

    Route::put('updatefuncionarios/{id}', 'App\Http\Controllers\FuncionarioController@updateFuncionarios');

    Route::delete('deletefuncionarios/{id}', 'App\Http\Controllers\FuncionarioController@deleteFuncionarios');


});

