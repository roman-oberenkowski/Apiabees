<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $performed_at
 * @property int $hive_id
 * @property string $action_type_name
 * @property string $employee_PESEL
 * @property string $action_description
 * @property ActionType $actionType
 * @property Employee $employee
 * @property Hive $hive
 */
class Action extends Model
{
    protected $primaryKey = ['performed_at', 'employee_PESEL'];

    public $incrementing = false;

    protected  $keyType = ['string', 'string'];
    /**
     * @var array
     */
    protected $fillable = [
        'hive_id',
        'action_type_name',
        'action_description'
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
    public function actionType()
    {
        return $this->belongsTo('App\Models\ActionType', 'action_type_name', 'name');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'employee_PESEL', 'PESEL');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hive()
    {
        return $this->belongsTo('App\Models\Hive');
    }

//    /**
//     * Set the keys for a save update query.
//     *
//     * @param  \Illuminate\Database\Eloquent\Builder  $query
//     * @return \Illuminate\Database\Eloquent\Builder
//     */
//    protected function setKeysForSaveQuery(Builder $query)
//    {
//        $keys = $this->getKeyName();
//        if(!is_array($keys)){
//            return parent::setKeysForSaveQuery($query);
//        }
//
//        foreach($keys as $keyName){
//            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
//        }
//
//        return $query;
//    }
//
//    /**
//     * Get the primary key value for a save query.
//     *
//     * @param mixed $keyName
//     * @return mixed
//     */
//    protected function getKeyForSaveQuery($keyName = null)
//    {
//        if(is_null($keyName)){
//            $keyName = $this->getKeyName();
//        }
//
//        if (isset($this->original[$keyName])) {
//            return $this->original[$keyName];
//        }
//
//        return $this->getAttribute($keyName);
//    }

}
