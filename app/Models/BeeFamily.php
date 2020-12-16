<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $species_name
 * @property int $hive_id
 * @property string $acquired_at
 * @property int $population
 * @property string $die_off_date
 * @property Hive $hive
 * @property Species $species
 * @property FamilyState[] $familyStates
 */
class BeeFamily extends Model
{
    use SoftDeletes;
    /**
     * @var array
     */
    protected $fillable = [
        'species_name',
        'hive_id',
        'acquired_at',
        'population',
        'die_off_date'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'acquired_at' => 'datetime:Y-m-d',
        'die_off_date' => 'datetime:Y-m-d',
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
    public function species()
    {
        return $this->belongsTo('App\Models\Species', 'species_name', 'name');
    }

    /**
     * @return HasMany
     */
    public function familyStates()
    {
        return $this->hasMany('App\Models\FamilyState');
    }

    /**
     * @return HasOne
     */
    public function hive()
    {
        return $this->hasOne('App\Models\Hive', 'bee_family_id');
    }
}
