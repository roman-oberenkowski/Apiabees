<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $code_name
 * @property string $name
 * @property float $area
 * @property string $parcel
 * @property string $street
 * @property string $city
 * @property int $row_num
 * @property int $col_num
 * @property float $latitude
 * @property float $longitude
 * @property TaskAssignment[] $employeesTasks
 * @property Hive[] $hives
 * @property HoneyProduction[] $honeyProductions
 * @property WaxProduction[] $waxProductions
 */
class Apiary extends Model
{
    public static function validationRulesCreate(){
        return [
            'code_name' => ['required', 'string', 'min:2','max:31','unique:apiaries'],
            'name' => ['required', 'string', 'min:2','max:63','unique:apiaries'],
            'area' => ['required', 'numeric', 'gt:0','lte:1000000'],
            'parcel' => ['required', 'string', 'min:1','max:7'],
            'street' => ['required', 'string', 'min:3','max:31'],
            'city' => ['required', 'string', 'min:3','max:31'],
            'col_num' => ['required', 'integer', 'gt:0','lte:50'],
            'row_num' => ['required', 'integer', 'gt:0','lte:50'],
            'latitude' => ['required', 'numeric', 'gte:0','lte:90'],
            'longitude' => ['required', 'numeric', 'gte:0','lte:180'],
        ];
    }
    public static function validationRulesUpdate()
    {

        $rules=self::validationRulesCreate();
        unset($rules['code_name']);
        unset($rules['name']);
        return $rules;
    }
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'code_name';

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
        'code_name',
        'name',
        'area',
        'parcel',
        'street',
        'city',
        'col_num',
        'row_num',
        'latitude',
        'longitude'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return BelongsToMany
     */
    public function employeeAssignedTasks()
    {
        return $this->belongsToMany('App\Models\TaskAssignment', 'task_assignments', 'apiary_code_name');
    }

    /**
     * @return HasMany
     */
    public function hives()
    {
        return $this->hasMany('App\Models\Hive', 'apiary_code_name', 'code_name');
    }

    /**
     * @return HasMany
     */
    public function honeyProductions()
    {
        return $this->hasMany('App\Models\HoneyProduction', 'apiary_code_name', 'code_name');
    }

    /**
     * @return HasMany
     */
    public function waxProductions()
    {
        return $this->hasMany('App\Models\WaxProduction', 'apiary_code_name', 'code_name');
    }
}
