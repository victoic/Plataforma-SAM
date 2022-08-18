<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Module
 * @package App\Models
 */
class Module extends Model
{

    public $table = 'modules';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    public $idAdventureForSearch = -1;


    public $fillable = [
        'name',
        'description',
        'topic',
        'story',
        'id_creator',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'topic' => 'string',
        'story' => 'string',
        'id_creator' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /*
     * Funções de relações
     */
    public function creator(){
        return $this->belongsTo('App\Models\Teacher', 'id_creator', 'id');
    }
    public function adventures(){
        return $this->belongsToMany('App\Models\Adventure', 'adventure_module', 'id_module', 'id_adventure')->withPivot('order');
    }
    public function adventurersDone(){
        return $this->belongsToMany('App\Models\Student', 'student_module_done', 'id_module', 'id_student')->withPivot('mistakes')->orderBy('mistakes', 'asc');
    }
    public function adventuresWithId(){
        return $this->belongsToMany('App\Models\Adventure', 'adventure_module', 'id_module', 'id_adventure')->where('id_adventure', $this->idAdventureForSearch)->withPivot('order');
    }
    public function activities(){
        return $this->belongsToMany('App\Models\Activity', 'module_activity', 'id_module', 'id_activity')->withPivot('order')->orderBy('order', 'asc');
    }
    public function topic(){
        return $this->belongsTo('App\Models\Topic', 'id_topic', 'id');
    }
}
