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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::prefix('/actions')->group(function () {
    Route::get('/add', function () {
        return 'Add';
    });
    Route::get('/{action}/edit', function () {
        return 'edit';
    });
    // Route::get('/{action}', function () {
    //     return 'show one';
    // });
    Route::get('/', function () {
        return 'show all';
    });
});

Route::prefix('/action_types')->group(function () {
    Route::get('/add', function () {
        return 'Add';
    });
    // Route::get('/{action_type}', function () {
    //     return 'show one';
    // });
    Route::get('/', function () {
        return 'show all';
    });
});

Route::prefix('/apiaries')->group(function () {
    Route::get('/add', function () {
        return 'Add';
    });
    Route::get('/{apiary}/edit', function () {
        return 'edit';
    });
    Route::get('/{apiary}/delete', function () {
        return 'delete';
    });
    Route::get('/{apiary}/hives', function () {
        return 'hives';
    });
    Route::get('/{apiary}/productions', function () {
        return 'productions';
    });
    // Route::get('/{apiary}', function () {
    //     return 'show one';
    // });
    Route::get('/', function () {
        return 'show all';
    });
});

Route::prefix('/attendances')->group(function () {
    Route::get('/add', function () {
        return 'Add';
    });
    Route::get('/{attendance}/finish', function () {
        return 'finish';
    });
    // Route::get('/{attendance}', function () {
    //     return 'show one';
    // });
    Route::get('/', function () {
        return 'show all';
    });
});

Route::prefix('/bee_families')->group(function () {
    Route::get('/add', function () {
        return 'Add';
    });
    Route::get('/{bee_family}/edit', function () {
        return 'edit';
    });
    Route::get('/{bee_family}/delete', function () {
        return 'delete';
    });
    Route::get('/{bee_family}/states', function () {
        return 'hives';
    });
    Route::get('/{bee_family}', function () {
        return 'show one';
    });
    Route::get('/', function () {
        return 'show all';
    });
});

Route::prefix('/employees')->group(function () {
    Route::get('/add', function () {
        return 'Add';
    });
    Route::get('/{employee}/edit', function () {
        return 'edit';
    });
    Route::get('/{employee}/delete', function () {
        return 'delete';
    });
    Route::get('/{employee}/assign_user', function () {
        return 'assign_user';
    });
    Route::prefix('/{employee}/actions')->group(function () {
        Route::get('/add', function () {
            return 'Add';
        });
        Route::get('/{action}/edit', function () {
            return 'edit';
        });
        // Route::get('/{action}', function () {
        //     return 'show one';
        // });
        Route::get('/', function () {
            return 'show all';
        });
    });
    Route::get('/{employee}/tasks', function () {
        return 'show all tasks';
    });
    Route::get('/{employee}', function () {
        return 'show one';
    });
    Route::get('/', function () {
        return 'show all';
    });
});

Route::prefix('/employee_tasks')->group(function () {
    Route::get('/add', function () {
        return 'Add';
    });
    Route::get('/{employee_task}/delete', function () {
        return 'delete';
    });
    // Route::get('/{employee_task}', function () {
    //     return 'show one';
    // });
    Route::get('/', function () {
        return 'show all';
    });
});

Route::prefix('/family_states')->group(function () {
    Route::get('/add', function () {
        return 'Add';
    });
    Route::get('/{family_state}/delete', function () {
        return 'delete';
    });
    Route::get('/{family_state}/edit', function () {
        return 'edit';
    });
    // Route::get('/{family_state}', function () {
    //     return 'show one';
    // });
    Route::get('/', function () {
        return 'show all';
    });
});

Route::prefix('/hives')->group(function () {
    Route::get('/add', function () {
        return 'Add';
    });
    Route::get('/{hive}/delete', function () {
        return 'delete';
    });
    Route::get('/{hive}/edit', function () {
        return 'edit';
    });
    // Route::get('/{hive}', function () {
    //     return 'show one';
    // });
    Route::get('/', function () {
        return 'show all';
    });
});

Route::prefix('/honey_productions')->group(function () {
    Route::get('/add', function () {
        return 'Add';
    });
    Route::get('/{honey_production}/delete', function () {
        return 'delete';
    });
    Route::get('/{honey_production}/edit', function () {
        return 'edit';
    });
    // Route::get('/{honey_production}', function () {
    //     return 'show one';
    // });
    Route::get('/', function () {
        return 'show all';
    });
});

Route::prefix('/honey_types')->group(function () {
    Route::get('/add', function () {
        return 'Add';
    });
    Route::get('/{honey_types}/delete', function () {
        return 'delete';
    });
    Route::get('/{honey_types}/edit', function () {
        return 'edit';
    });
    // Route::get('/{honey_types}', function () {
    //     return 'show one';
    // });
    Route::get('/', function () {
        return 'show all';
    });
});

Route::prefix('/species')->group(function () {
    Route::get('/add', function () {
        return 'Add';
    });
    Route::get('/{specie}/delete', function () {
        return 'delete';
    });
    Route::get('/{specie}/edit', function () {
        return 'edit';
    });
    // Route::get('/{specie}', function () {
    //     return 'show one';
    // });
    Route::get('/', function () {
        return 'show all';
    });
});

Route::prefix('/state_types')->group(function () {
    Route::get('/add', function () {
        return 'Add';
    });
    Route::get('/{state_type}/delete', function () {
        return 'delete';
    });
    Route::get('/{state_type}/edit', function () {
        return 'edit';
    });
    // Route::get('/{state_type}', function () {
    //     return 'show one';
    // });
    Route::get('/', function () {
        return 'show all';
    });
});

Route::prefix('/tasks')->group(function () {
    Route::get('/add', function () {
        return 'Add';
    });
    Route::get('/{task}/delete', function () {
        return 'delete';
    });
    Route::get('/{task}/edit', function () {
        return 'edit';
    });
    // Route::get('/{task}', function () {
    //     return 'show one';
    // });
    Route::get('/', function () {
        return 'show all';
    });
});

Route::prefix('/wax_productions')->group(function () {
    Route::get('/add', function () {
        return 'Add';
    });
    Route::get('/{wax_production}/delete', function () {
        return 'delete';
    });
    Route::get('/{wax_production}/edit', function () {
        return 'edit';
    });
    // Route::get('/{wax_production}', function () {
    //     return 'show one';
    // });
    Route::get('/', function () {
        return 'show all';
    });
});