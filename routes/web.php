<?php

use Illuminate\Support\Facades\Route;

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
    //default
    Route::get('/', function () {
        return redirect()->route('attendances.index');
    });

    //actions
    Route::get('/actions/create', function () {
        return view('action.create');
    })->name('actions.create');

    Route::get('/actions/', function () {
        return view('action.index');
    })->name('actions.index');;

    //action types
    Route::get('/action-types/', function () {
        return view('action-type.index');
    })->name('action-types.index');

    Route::get('/action-types/create', function () {
        return view('action-type.create');
    })->name('action-types.create');

    //apiaries
    Route::get('/apiaries/create', function () {
        return view('apiary.create');
    })->name('apiaries.create');

    Route::get('/apiaries/', function () {
        return view('apiary.index');
    })->name('apiaries.index');;

    //attendance
    Route::get('/attendances/', function () {
        return view('attendance.index');
    })->name('attendances.index');

    //bee families
    Route::get('/bee-families/create', function () {
        return view('bee-family.create');
    })->name('bee-families.create');

    Route::get('/bee-families/', function () {
        return view('bee-family.index');
    })->name('bee-families.index');;

    //employees
    Route::get('/employees/create', function () {
        return view('employee.create');
    })->name('employees.create');

    Route::get('/employees/', function () {
        return view('employee.index');
    })->name('employees.index');;

    //hives
    Route::get('/hives/create', function () {
        return view('hive.create');
    })->name('hives.create');

    Route::get('/hives/', function () {
        return view('hive.index');
    })->name('hives.index');;

    //honey types
    Route::get('/honey-types/create', function () {
        return view('honey-type.create');
    })->name('honey-types.create');

    Route::get('/honey-types/', function () {
        return view('honey-type.index');
    })->name('honey-types.index');;

    //productions
    Route::get('/productions/create', function () {
        return view('production.create');
    })->name('productions.create');

    Route::get('/productions/', function () {
        return view('production.index');
    })->name('productions.index');

    //scanner
    Route::get('/scan/', function () {
        return view('scanner.scan');
    })->name('scanner.scan');

    //species
    Route::get('/species/create', function () {
        return view('species.create');
    })->name('species.create');

    Route::get('/species/', function () {
        return view('species.index');
    })->name('species.index');;

    //state types
    Route::get('/state-types/create', function () {
        return view('state-type.create');
    })->name('state-types.create');

    Route::get('/state-types/', function () {
        return view('state-type.index');
    })->name('state-types.index');;

    //task assignments
    Route::get('/task-assignments/create', function () {
        return view('task-assignment.create');
    })->name('task-assignments.create');

    Route::get('/task-assignments/', function () {
        return view('task-assignment.index');
    })->name('task-assignments.index');

    //task types
    Route::get('/task-types/create', function () {
        return view('task-type.create');
    })->name('task-types.create');

    Route::get('/task-types/', function () {
        return view('task-type.index');
    })->name('task-types.index');;
});



