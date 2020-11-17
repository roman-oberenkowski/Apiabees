<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    /**
     * @var array
     */
    protected $fillable = [
        'state_type_name',
        'inspection_description'
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
