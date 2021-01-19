<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $checked_at
 * @property int $bee_family_id
 * @property string $state_type_name
 * @property string $inspection_description
 * @property BeeFamily $beeFamily
 * @property StateType $stateType
 */
class FamilyState extends Model
{
    protected $fillable = [
        'checked_at',
        'bee_family_id',
        'state_type_name',
        'inspection_description'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'checked_at' => 'datetime:Y-m-d h:i:s',
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
    public function beeFamily()
    {
        return $this->belongsTo('App\Models\BeeFamily');
    }

    /**
     * @return BelongsTo
     */
    public function stateType()
    {
        return $this->belongsTo('App\Models\StateType', 'state_type_name', 'name');
    }
}
