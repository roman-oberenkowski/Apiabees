<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $started_at
 * @property string $finished_at
 * @property string $employee_PESEL
 * @property Employee $employee
 */
class Attendance extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'started_at',
        'finished_at',
        'employee_PESEL'
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
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'employee_PESEL', 'PESEL');
    }
}
