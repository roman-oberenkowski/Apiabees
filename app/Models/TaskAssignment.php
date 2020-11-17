<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $task_id
 * @property string $apiary_code_name
 * @property string $employee_PESEL
 * @property Apiary $apiary
 * @property Employee $employee
 * @property TaskType $task
 */
class TaskAssignment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'task_assignments';

    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function apiary()
    {
        return $this->belongsTo('App\Models\Apiary', 'apiary_code_name', 'code_name');
    }

    /**
     * @return BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'employee_PESEL', 'PESEL');
    }

    /**
     * @return BelongsTo
     */
    public function taskType()
    {
        return $this->belongsTo('App\Models\TaskType', 'task_type_name');
    }
}
