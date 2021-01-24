<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Validation\Rule;

/**
 * @property string $name
 * @property Action[] $actions
 */
class ActionType extends Model
{
    public const special_action_inspection="Inspekcja";
    public const special_action_other="Inna";
    public static function isSpecial($action){
        if($action==self::special_action_inspection)return true;
        if($action==self::special_action_other)return true;
        return false;
    }

    protected $primaryKey = 'name';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public static function validationRulesCreate()
    {
        return ['name' => ['required', 'string', 'max:32', 'min:2', Rule::unique('action_types')]];
    }

    public function actions()
    {
        return $this->hasMany('App\Models\Action', 'type_name', 'name');
    }
}
