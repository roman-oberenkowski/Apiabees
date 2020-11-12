<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $started_at
 * @property string $finished_at
 * @property string $employee_PESEL
 * @property Employee $employee
 */
class Attendance extends Model
{
    protected $primaryKey = ['started_at', 'employee_PESEL'];

    public $incrementing = false;

    protected  $keyType = ['string', 'string'];

    /**
     * @var array
     */
    protected $fillable = [
        'finished_at',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'employee_PESEL', 'PESEL');
    }
}
