<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $apiary_code_name
 * @property int $bee_family_id
 * @property string $material
 * @property string $nfc_tag
 * @property string $qr_code
 * @property int $location_row
 * @property int $location_column
 * @property Apiary $apiary
 * @property Action[] $actions
 * @property BeeFamily $beeFamily
 */
class Hive extends Model
{
    use SoftDeletes;
    /**
     * @var array
     */
    protected $fillable = [
        'apiary_code_name',
        'bee_family_id',
        'material',
        'nfc_tag',
        'qr_code',
        'location_row',
        'location_column'
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
     * @return HasMany
     */
    public function actions()
    {
        return $this->hasMany('App\Models\Action');
    }

    /**
     * @return HasOne
     */
    public function beeFamily()
    {
        return $this->hasOne('App\Models\BeeFamily', 'hive_id');
    }
}
