<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Krlove\EloquentModelGenerator\Model\HasOne;

/**
 * @property string $PESEL
 * @property string $first_name
 * @property string $last_name
 * @property float $salary
 * @property string $date_of_employment
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
        'date_of_employment',
        'appartement',
        'house_number',
        'street',
        'city'
    ];
    public static function validationRulesCreate(){
        return [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'min:5'],
            'password' => ['required', 'string', 'confirmed', 'min:6'],

            'PESEL' => ['required', 'string', 'size:11', 'unique:employees', 'regex:/^\d{11}?$/'],
            'first_name' => ['required', 'string', 'max:32', 'min:3'],
            'last_name' => ['required', 'string', 'max:32', 'min:3'],
            'salary' => ['required', 'numeric', 'gt:0', 'regex:/^\d+(\.\d{1,2})?$/'],
            'date_of_employment' => ['required', 'date', 'before_or_equal:today'],
            'appartement' => ['nullable', 'string', 'min:1', 'max:4'],
            'house_number' => ['string', 'required', 'min:1', 'max:8'],
            'street' => ['string', 'required', 'min:1','max:32'],
            'city' => ['string', 'required', 'min:1','max:32'],
        ];
    }
    public static function validationRulesUpdate()
    {
        return [
             'password' => ['nullable', 'string', 'confirmed', 'min:8'],



            'first_name' => ['required', 'string', 'max:32', 'min:3'],
            'last_name' => ['required', 'string', 'max:32', 'min:3'],
            'salary' => ['required', 'numeric', 'gt:0', 'regex:/^\d+(\.\d{1,2})?$/'],
            'date_of_employment' => ['required', 'date', 'before_or_equal:today'],
            'appartement' => ['nullable', 'string', 'min:1','max:4'],
            'house_number' => ['string', 'required', 'min:1'],
            'street' => ['string', 'required', 'min:1'],
            'city' => ['string', 'required', 'min:1'],
        ];
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date_of_employment' => 'datetime:Y-m-d',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'employee_PESEL', 'PESEL');
    }

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
