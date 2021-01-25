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
            'code_name' => ['required', 'string', 'min:2','max:32','unique:apiaries'],
            'name' => ['required', 'string', 'min:2','max:64','unique:apiaries'],
            'area' => ['required', 'numeric', 'gt:0','lte:1000000','regex:/^\d*(.\d{1,2})?$/'],
            'parcel' => ['required', 'string', 'min:1','max:8'],
            'street' => ['required', 'string', 'min:3','max:32'],
            'city' => ['required', 'string', 'min:3','max:32'],
            'col_num' => ['required', 'integer', 'gt:0','lte:100'],
            'row_num' => ['required', 'integer', 'gt:0','lte:100'],
            'latitude' => ['required', 'numeric', 'gt:0','lt:90','regex:/^\d*(.\d{1,4})?$/'],
            'longitude' => ['required', 'numeric', 'gt:0','lt:180','regex:/^\d*(.\d{1,4})?$/'],
        ];
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
