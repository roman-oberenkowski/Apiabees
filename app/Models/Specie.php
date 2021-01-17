<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

/**
 * @property string $name
 * @property string $latin_name
 * @property boolean $is_aggressive
 * @property BeeFamily[] $beeFamilies
 */
class Specie extends Model
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
        'name',
        'latin_name',
        'is_aggressive'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return HasMany
     */
    public function beeFamilies()
    {
        return $this->hasMany('App\Models\BeeFamily', 'species_name', 'name');
    }

    public static function validationRulesCreate()
    {
        return [
            'name' => ['required', 'string', 'max:32', 'min:2', Rule::unique('species')],
            'latin_name' => ['required', 'string', 'max:32', 'min:2'],
            'is_aggressive' => ['required', 'boolean']
            ];
    }

}
