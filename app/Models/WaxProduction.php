<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $produced_at
 * @property string $apiary_code_name
 * @property float $produced_weight
 * @property Apiary $apiary
 */
class WaxProduction extends Model
{
    protected $primaryKey = ['produced_at', 'apiary_code_name'];

    public $incrementing = false;

    protected  $keyType = ['string', 'string'];

    /**
     * @var array
     */
    protected $fillable = ['produced_weight'];

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
}
