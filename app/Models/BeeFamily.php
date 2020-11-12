<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function species()
    {
        return $this->belongsTo('App\Models\Species', 'species_name', 'name');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function familyStates()
    {
        return $this->hasMany('App\Models\FamilyState');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hive()
    {
        return $this->hasOne('App\Models\Hive', 'bee_family_id');
    }
}
