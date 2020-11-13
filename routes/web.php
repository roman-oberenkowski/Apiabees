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

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('/actions')->group(function () {
        Route::get('/', function () {
            return 'index';
        });
        Route::get('/create', function () {
            return 'create';
        });
        Route::post('/', function () {
            return 'store';
        });
        Route::get('/{action}/edit', function () {
            return 'edit';
        });
        Route::put('/', function () {
            return 'update';
        });
        // Route::delete('/{action}', function () {
        //     return 'delete';
        // });
        // Route::get('/{action}', function () {
        //     return 'show';
        // });

    });

    Route::prefix('/action_types')->group(function () {
        Route::get('/', function () {
            return 'index';
        });
        Route::get('/create', function () {
            return 'create';
        });
        Route::post('/', function () {
            return 'store';
        });
        // Route::get('/{action_type}/edit', function () {
        //     return 'edit';
        // });
        // Route::put('/', function () {
        //     return 'update';
        // });
        // Route::delete('/{action_type}', function () {
        //     return 'delete';
        // });
        // Route::get('/{action_type}', function () {
        //     return 'show';
        // });
    });

    Route::prefix('/apiaries')->group(function () {
        Route::get('/', function () {
            return 'index';
        });
        Route::get('/create', function () {
            return 'create';
        });
        Route::post('/', function () {
            return 'store';
        });
        Route::get('/{apiary}/edit', function () {
            return 'edit';
        });
        Route::put('/', function () {
            return 'update';
        });
        Route::delete('/{apiary}', function () {
            return 'delete';
        });
        Route::get('/{apiary}/hives', function () {
            return 'hives';
        });
        Route::get('/{apiary}/productions', function () {
            return 'productions';
        });
        // Route::get('/{apiary}', function () {
        //     return 'show';
        // });
    });

    Route::prefix('/attendances')->group(function () {
        Route::get('/', function () {
            return 'index';
        });
        Route::get('/create', function () {
            return 'create';
        });
        Route::post('/', function () {
            return 'store';
        });
        Route::get('/{attendance}/finish', function () {
            return 'finish';
        });
        Route::put('/{attendance}', function () {
            return 'update';
        });
        // Route::get('/{attendance}', function () {
        //     return 'show';
        // });
    });


    Route::prefix('/bee_families')->group(function () {
        Route::get('/', function () {
            return 'index';
        });
        Route::get('/create', function () {
            return 'create';
        });
        Route::post('/', function () {
            return 'store';
        });
        Route::get('/{bee_family}/edit', function () {
            return 'edit';
        });
        Route::put('/{bee_family}', function () {
            return 'update';
        });
        Route::delete('/{bee_family}', function () {
            return 'delete';
        });
        Route::get('/{bee_family}/states', function () {
            return 'states';
        });
        Route::get('/{bee_family}', function () {
            return 'show';
        });
    });

//may be incomplete
    Route::prefix('/employees')->group(function () {
        Route::get('/', function () {
            return 'index';
        });
        Route::get('/create', function () {
            return 'create';
        });
        Route::post('/', function () {
            return 'store';
        });
        Route::get('/{employee}/edit', function () {
            return 'edit';
        });
        Route::delete('/{employee}', function () {
            return 'delete';
        });
        Route::get('/{employee}/assign_user', function () {
            return 'assign_user';
        });
        Route::prefix('/{employee}/actions')->group(function () {
            Route::get('/create', function () {
                return 'create';
            });
            Route::get('/{action}/edit', function () {
                return 'edit';
            });
            // Route::get('/{action}', function () {
            //     return 'show';
            // });
            Route::get('/', function () {
                return 'index';
            });
        });
        Route::get('/{employee}/tasks', function () {
            return 'index tasks';
        });
        Route::get('/{employee}', function () {
            return 'show';
        });
    });


    Route::prefix('/employee_tasks')->group(function () {
        Route::get('/', function () {
            return 'index';
        });
        Route::get('/create', function () {
            return 'create';
        });
        Route::post('/', function () {
            return 'store';
        });
        Route::delete('/{employee_task}', function () {
            return 'delete';
        });
        // Route::get('/{employee_task}', function () {
        //     return 'show';
        // });
    });

    Route::prefix('/family_states')->group(function () {
        Route::get('/', function () {
            return 'index';
        });
        Route::get('/create', function () {
            return 'create';
        });
        Route::post('/', function () {
            return 'store';
        });
        Route::get('/{family_state}/edit', function () {
            return 'edit';
        });
        Route::put('/{family_state}', function () {
            return 'update';
        });
        Route::delete('/{family_state}', function () {
            return 'delete';
        });
        // Route::get('/{family_state}', function () {
        //     return 'show';
        // });
    });

    Route::prefix('/hives')->group(function () {
        Route::get('/', function () {
            return 'index';
        });
        Route::get('/create', function () {
            return 'create';
        });
        Route::post('/', function () {
            return 'store';
        });
        Route::get('/{hive}/edit', function () {
            return 'edit';
        });
        Route::put('/{hive}', function () {
            return 'update';
        });
        Route::delete('/{hive}', function () {
            return 'delete';
        });
        // Route::get('/{hive}', function () {
        //     return 'show';
        // });
    });



    Route::prefix('/honey_types')->group(function () {
        Route::get('/', function () {
            return 'index';
        });
        Route::get('/create', function () {
            return 'create';
        });
        Route::post('/', function () {
            return 'store';
        });
        // Route::get('/{honey_type}/edit', function () {
        //     return 'edit';
        // });
        // Route::put('/{honey_type}', function () {
        //     return 'update';
        // });
        // Route::delete('/{honey_type}', function () {
        //     return 'delete';
        // });
        // Route::get('/{honey_type}', function () {
        //     return 'show';
        // });
    });

    Route::prefix('/species')->group(function () {
        Route::get('/', function () {
            return 'index';
        });
        Route::get('/create', function () {
            return 'create';
        });
        Route::post('/', function () {
            return 'store';
        });
        // Route::get('/{specie}/edit', function () {
        //     return 'edit';
        // });
        // Route::put('/{specie}', function () {
        //     return 'update';
        // });
        // Route::delete('/{specie}', function () {
        //     return 'delete';
        // });
        // Route::get('/{specie}', function () {
        //     return 'show';
        // });
    });

    Route::prefix('/state_types')->group(function () {
        Route::get('/', function () {
            return 'index';
        });
        Route::get('/create', function () {
            return 'create';
        });
        Route::post('/', function () {
            return 'store';
        });
        // Route::get('/{state_type}/edit', function () {
        //     return 'edit';
        // });
        // Route::put('/{state_type}', function () {
        //     return 'update';
        // });
        // Route::delete('/{state_type}', function () {
        //     return 'delete';
        // });
        // Route::get('/{state_type}', function () {
        //     return 'show';
        // });
    });

    Route::prefix('/tasks')->group(function () {
        Route::get('/', function () {
            return 'index';
        });
        Route::get('/create', function () {
            return 'create';
        });
        Route::post('/', function () {
            return 'store';
        });
        Route::get('/{task}/edit', function () {
            return 'edit';
        });
        Route::put('/{task}', function () {
            return 'update';
        });
        Route::delete('/{task}', function () {
            return 'delete';
        });
        Route::get('/{task}', function () {
            return 'show';
        });
    });

    Route::prefix('/honey_productions')->group(function () {
        Route::get('/', function () {
            return 'index';
        });
        Route::get('/create', function () {
            return 'create';
        });
        Route::post('/', function () {
            return 'store';
        });
        Route::get('/{honey_production}/edit', function () {
            return 'edit';
        });
        Route::put('/{honey_production}', function () {
            return 'update';
        });
        Route::delete('/{honey_production}', function () {
            return 'delete';
        });
        // Route::get('/{honey_production}', function () {
        //     return 'show';
        // });
    });

    Route::prefix('/wax_productions')->group(function () {
        Route::get('/', function () {
            return 'index';
        });
        Route::get('/create', function () {
            return 'create';
        });
        Route::post('/', function () {
            return 'store';
        });
        Route::get('/{wax_production}/edit', function () {
            return 'edit';
        });
        Route::put('/{wax_production}/edit', function () {
            return 'update';
        });
        Route::delete('/{wax_production}', function () {
            return 'delete';
        });
        // Route::get('/{wax_production}', function () {
        //     return 'show';
        // });
    });
});



