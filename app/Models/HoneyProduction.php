<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    protected $primaryKey = ['produced_at', 'apiary_code_name'];

    public $incrementing = false;

    protected  $keyType = ['string', 'string'];

    /**
     * @var array
     */
    protected $fillable = ['honey_type_name', 'produced_weight'];

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
    public function honeyType()
    {
        return $this->belongsTo('App\Models\HoneyType', 'honey_type_name', 'name');
    }
}
