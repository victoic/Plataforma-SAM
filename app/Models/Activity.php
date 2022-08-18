<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Activity
 * @package App\Models
 */
class Activity extends Model
{

    public $table = 'activities';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    public $idModuleForSearch = -1;


    public $fillable = [
        'description',
        'topic',
        'story',
        'id_creator',
        'id_module',
        'order',
        'completed'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'description' => 'string',
        'topic' => 'string',
        'story' => 'string',
        'id_creator' => 'integer',
        'id_module' => 'integer',
        'order' => 'integer',
        'completed' => 'boolean'
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
    public function creator(){
        return $this->belongsTo('App\Models\Teacher', 'id_creator', 'id');
    }
    public function exercises(){
        return $this->hasMany('App\Models\Exercise', 'id_activity');
    }
    public function modules(){
        return $this->belongsToMany('App\Models\Module', 'module_activity', 'id_activity', 'id_module')->withPivot('order');
    }
    public function modulesWithId(){
        return $this->belongsToMany('App\Models\Module', 'module_activity', 'id_activity', 'id_module')->where('id_module', $this->idModuleForSearch)->withPivot('order');
    }
    public function adventurers(){
        return $this->hasMany('App\Models\Student', 'id_unlocked_activity', 'id');
    }
    public function adventurersDone(){
        return $this->belongsToMany('App\Models\Student', 'student_activity_done', 'id_activity', 'id_student')->withPivot('mistakes')->withPivot('minTime')->withPivot('maxTime')->orderBy('mistakes', 'asc');
    }
    public function topic(){
        return $this->belongsTo('App\Models\Topic', 'id_topic', 'id');
    }
}
