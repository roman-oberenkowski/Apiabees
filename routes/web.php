<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\ActionTypeController;
use App\Http\Controllers\ApiaryController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BeeFamilyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeTaskController;
use App\Http\Controllers\FamilyStateController;
use App\Http\Controllers\HiveController;
use App\Http\Controllers\HoneyProducionController;
use App\Http\Controllers\HoneyTypeController;
use App\Http\Controllers\SpecieController;
use App\Http\Controllers\StateTypeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WaxProductionController;

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
Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/example', function () {
        return view('example');
    });

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    
    
    //APIARIES
    Route::resource('apiaries', ApiaryController::class)->only([
        'index', 'create', 'store', 'show'
    ]);
    Route::resource('apiaries.hives', HiveController::class)->shallow()->only([
        'index', 'create', 'store', 'show'
    ]);
    Route::resource('apiaries.waxproducions', WaxProducionController::class)->only([
        'index', 'create', 'store', 'show'
    ]);
    Route::resource('apiaries.honeyproducions', HoneyProducionController::class)->only([
        'index', 'create', 'store', 'show'
    ]);
    

    //BEE_FAMILIIES  
    Route::resource('bee_families', BeeFamilyController::class)->only([
        'index', 'create', 'store', 'show', 'edit', 'update'
    ]);
    Route::resource('bee_families.family_states', FamilyStateController::class)->only([
        'index', 'create', 'store', 'show'
    ]);

    
    //EMPLOYEES
    Route::resource('employees', EmployeeController::class)->only([
        'index', 'create', 'store', 'show', 'edit', 'update'
    ]);
    //jeśli do action będzie slug to: Route::resource('employees.actions', ActionController::class)->shallow()->only([
    Route::resource('employees.actions', ActionController::class)->only([
        'index', 'create', 'store', 'show'
    ]);

    Route::resource('employees.attendances', AttendanceController::class)->only([
        'index', 'create', 'store', 'show' 
    ]);
 
    Route::resource('employees.employee_tasks', EmployeeTaskController::class)->only([
        'index', 'create', 'store', 'show'
    ]);

    //HIVES
    Route::resource('hives', HiveController::class)->only([
        'index', 'create', 'store', 'show', 'edit', 'update'
    ]);
    Route::resource('hives.family_states', FamilyStateController::class)->only([
        'index', 'create', 'store', 'show', 'edit', 'update'
    ]);

    //OTHER
    Route::resource('employee_tasks', EmployeeTaskController::class)->only([
        'index', 'create', 'store', 'show', 'destroy'
    ]);
    
    Route::resource('tasks', TaskController::class)->only([
        'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
    ]);
    
    Route::resource('honey_productions', HoneyProductionController::class)->only([
        'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
    ]);

    Route::resource('wax_productions', WaxProductionController::class)->only([
        'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
    ]);

    //DICTIONARY TABLES //opcjonalnie dodac destroy lub 
    Route::resource('action_types', ActionTypeController::class)->only([
        'index', 'create', 'store'
    ]);

    Route::resource('honey_types', HoneyTypeController::class)->only([
        'index', 'create', 'store'
    ]);

    Route::resource('species', SpecieController::class)->only([
        'index', 'create', 'store'
    ]);
    
    Route::resource('state_types', StateTypeController::class)->only([
        'index', 'create', 'store'
    ]);
});



