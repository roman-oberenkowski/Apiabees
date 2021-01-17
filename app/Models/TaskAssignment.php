<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string apiary_code_name
 * @property string $assignment_date
 * @property string $employee_PESEL
 * @property string $task_type_name
 * @property Apiary $apiary
 * @property Employee $employee
 * @property TaskType $task_type
 */
class TaskAssignment extends Model
{
    public static function validationRulesCreate(){
        return [
            'apiary_code_name' => ['required','exists:apiaries,code_name'],
            'task_type_name' => ['required','exists:task_types,name'],
            'employee_PESEL'=> ['required','exists:employees,PESEL']
        ];
    }

    protected $table = 'task_assignments';

    /**
     * @var array
     */
    protected $fillable = [
        'assignment_date',
        'employee_PESEL',
        'task_type_name',
        'apiary_code_name'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'assignment_date' => 'datetime:Y-m-d',
    ];

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
