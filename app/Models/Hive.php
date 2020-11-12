<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function apiary()
    {
        return $this->belongsTo('App\Models\Apiary', 'apiary_code_name', 'code_name');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actions()
    {
        return $this->hasMany('App\Models\Action');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function beeFamily()
    {
        return $this->hasOne('App\Models\BeeFamily', 'hive_id');
    }
}
