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

    protected  $keyType = array('string', 'string');
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
    //fix from https://github.com/mopo922/LaravelTreats/blob/master/src/Model/Traits/HasCompositePrimaryKey.php
    public function getKey()
    {
        $attributes = [];

        foreach ($this->getKeyName() as $key) {
            $attributes[$key] = $this->getAttribute($key);
        }

        return $attributes;
    }

    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery($query)
    {
        foreach ($this->getKeyName() as $key) {
            if (isset($this->$key))
                $query->where($key, '=', $this->$key);
            else
                throw new Exception(__METHOD__ . 'Missing part of the primary key: ' . $key);
        }

        return $query;
    }

    /**
     * Execute a query for a single record by ID.
     *
     * @param  array  $ids Array of keys, like [column => value].
     * @param  array  $columns
     * @return mixed|static
     */
    public static function find($ids, $columns = ['*'])
    {
        $me = new self;
        $query = $me->newQuery();

        foreach ($me->getKeyName() as $key) {
            $query->where($key, '=', $ids[$key]);
        }

        return $query->first($columns);
    }

    /**
     * Find a model by its primary key or throw an exception.
     *
     * @param mixed $ids
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public static function findOrFail($ids, $columns = ['*'])
    {
        $result = self::find($ids, $columns);

        if (!is_null($result)) {
            return $result;
        }

        throw (new ModelNotFoundException)->setModel(
            __CLASS__, $ids
        );
    }

    /**
     * Reload the current model instance with fresh attributes from the database.
     *
     * @return $this
     */
    public function refresh()
    {
        if (!$this->exists) {
            return $this;
        }

        $this->setRawAttributes(
            static::findOrFail($this->getKey())->attributes
        );

        $this->load(collect($this->relations)->except('pivot')->keys()->toArray());

        return $this;
    }

}
