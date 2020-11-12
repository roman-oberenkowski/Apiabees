<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $task_id
 * @property string $apiary_code_name
 * @property string $employee_PESEL
 * @property Apiary $apiary
 * @property Employee $employee
 * @property Task $task
 */
class EmployeeTask extends Model
{
    protected $primaryKey = ['apiary_code_name', 'employee_PESEL', 'task_id'];

    public $incrementing = false;

    protected  $keyType = ['string', 'string', 'int'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employees_tasks';

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function apiary()
    {
        return $this->belongsTo('App\Models\Apiary', 'apiary_code_name', 'code_name');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'employee_PESEL', 'PESEL');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo('App\Models\Task');
    }
}
