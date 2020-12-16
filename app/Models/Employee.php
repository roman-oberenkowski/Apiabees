<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $PESEL
 * @property string $first_name
 * @property string $last_name
 * @property float $salary
 * @property string $email
 * @property string $date_of_employment
 * @property string $date_of_release
 * @property string $appartement
 * @property string $house_number
 * @property string $street
 * @property string $city
 * @property Action[] $actions
 * @property Attendance[] $attendances
 * @property EmployeesTask[] $employeesTasks
 */
class Employee extends Model
{
    use SoftDeletes;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'PESEL';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = [
        'PESEL',
        'first_name',
        'last_name',
        'salary',
        'email',
        'date_of_employment',
        'date_of_release',
        'appartement',
        'house_number',
        'street',
        'city'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date_of_employment' => 'datetime:Y-m-d',
        'date_of_release' => 'datetime:Y-m-d',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return HasMany
     */
    public function actions()
    {
        return $this->hasMany('App\Models\Action', 'employee_PESEL', 'PESEL');
    }

    /**
     * @return HasMany
     */
    public function attendances()
    {
        return $this->hasMany('App\Models\Attendance', 'employee_PESEL', 'PESEL');
    }

    /**
     * @return HasMany
     */
    public function assignedTasks()
    {
        return $this->hasMany('App\Models\TaskAssignment', 'task_assignments', 'PESEL');
    }
}
