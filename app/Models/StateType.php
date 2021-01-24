<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

/**
 * @property string $name
 * @property FamilyState[] $familyStates
 */
class StateType extends Model
{

    public const special_state_population_changed="Zmiana populacji";
    public const special_state_family_dead="Wymarcie rodziny";
    public const special_state_other="Inna";
    public static function isSpecial($action){
        if($action==self::special_state_population_changed)return true;
        if($action==self::special_state_family_dead)return true;
        if($action==self::special_state_other)return true;
        return false;
    }
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
    protected $fillable = [ 'name' ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return HasMany
     */
    public function familyStates()
    {
        return $this->hasMany('App\Models\FamilyState', 'state_type_name', 'name');
    }

    public static function validationRulesCreate()
    {
        return ['name' => ['required', 'string', 'max:32', 'min:2', Rule::unique('state_types')]];
    }
}
