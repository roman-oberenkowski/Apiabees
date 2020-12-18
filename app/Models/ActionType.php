<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $name
 * @property Action[] $actions
 */
class ActionType extends Model
{


    use SoftDeletes;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'name';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public static function validationRulesCreate()
    {
        return ['name' => ['required', 'string', 'max:32', 'min:2']];
    }


    /**
     * @return HasMany
     */
    public function actions()
    {
        return $this->hasMany('App\Models\Action', 'action_type_name', 'name');
    }
}
