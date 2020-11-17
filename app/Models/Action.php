<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $performed_at
 * @property int $hive_id
 * @property string $action_type_name
 * @property string $employee_PESEL
 * @property string $action_description
 * @property ActionType $actionType
 * @property Employee $employee
 * @property Hive $hive
 */
class Action extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'employee_PESEL',
        'performed_at',
        'hive_id',
        'action_type_name',
        'action_description'
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
    public function actionType()
    {
        return $this->belongsTo('App\Models\ActionType', 'action_type_name', 'name');
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
    public function hive()
    {
        return $this->belongsTo('App\Models\Hive');
    }

}
