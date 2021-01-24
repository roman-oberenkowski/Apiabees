<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $produced_at
 * @property string $apiary_code_name
 * @property float $produced_weight
 * @property Apiary $apiary
 */
class WaxProduction extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'produced_at',
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
}
