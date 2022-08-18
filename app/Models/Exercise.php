<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Exercise
 * @package App\Models
 */
class Exercise extends Model
{

    public $table = 'exercises';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'stem',
        'topic',
        'type',
        'id_activity'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'stem' => 'string',
        'topic' => 'string',
        'type' => 'integer',
        'id_activity' => 'integer',
        'image1' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /*
     * Funções de relações (TODO)
     */
    public function alternatives(){
        return $this->hasMany('App\Models\Alternative', 'id_exercise');
    }
    public function activities(){
        return $this->belongsTo('App\Models\Activity', 'id', 'id_activity');
    }
    public function topic(){
        return $this->belongsTo('App\Models\Topic', 'id_topic', 'id');
    }
}
