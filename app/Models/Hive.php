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
    public static function validationRulesCreate(){
        return [
            'material' => ['required','string','min:2','max:31'],
            'nfc_tag' => ['nullable','string','min:2, max:127','unique:hives,nfc_tag'],
            'qr_code' => ['nullable','string','min:2, max:31','unique:hives,qr_code'],
            'apiary_code_name' => ['nullable','string', 'exists:apiaries,code_name','required_with:location_row','required_with:location_column'],
            'location_row'=> ['nullable','integer','gte:1', 'lte:1000','required_with:apiary_code_name','required_with:location_column'],
            'location_column'=> ['nullable','integer','gte:1', 'lte:1000', 'required_with:apiary_code_name','required_with:location_row'],
        ];
    }

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
