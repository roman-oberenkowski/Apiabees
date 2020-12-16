<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $produced_at
 * @property string $apiary_code_name
 * @property string $honey_type_name
 * @property float $produced_weight
 * @property Apiary $apiary
 * @property HoneyType $honeyType
 */
class HoneyProduction extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'produced_at',
        'honey_type_name',
        'produced_weight',
        'apiary_code_name'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'produced_at' => 'datetime:Y-m-d',
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
    public function honeyType()
    {
        return $this->belongsTo('App\Models\HoneyType', 'honey_type_name', 'name');
    }
}
