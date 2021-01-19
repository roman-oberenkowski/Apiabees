<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

/**
 * @property int $id
 * @property string $name
 * @property TaskAssignment[] $employeesTasks
 */
class TaskType extends Model
{

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'name';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

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
     * @return HasMany
     */
    public function employeesTasks()
    {
        return $this->hasMany('App\Models\TaskAssignment');
    }

    public static function validationRulesCreate()
    {
        return ['name' => ['required', 'string', 'max:32', 'min:2', Rule::unique('task_types')]];
    }

}
