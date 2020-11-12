<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property EmployeesTask[] $employeesTasks
 */
class Task extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employeesTasks()
    {
        return $this->hasMany('App\Models\EmployeeTask');
    }
}
