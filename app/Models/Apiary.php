<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $code_name
 * @property string $name
 * @property float $area
 * @property string $parcel
 * @property string $street
 * @property string $city
 * @property int $max_hives_count
 * @property float $latitude
 * @property float $longitude
 * @property TaskAssignment[] $employeesTasks
 * @property Hive[] $hives
 * @property HoneyProduction[] $honeyProductions
 * @property WaxProduction[] $waxProductions
 */
class Apiary extends Model
{
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
