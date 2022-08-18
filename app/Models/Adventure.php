<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Adventure
 * @package App\Models
 */
class Adventure extends Model
{

    public $table = 'adventures';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name',
        'description',
        'story',
        'id_creator'
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
        'story' => 'string',
        'id_creator' => 'integer'
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
    public function adventurers(){
        return $this->hasMany('App\Models\Student', 'id_adventure', 'id');
    }
    public function adventurersDone(){
        return $this->belongsToMany('App\Models\Student', 'student_adventure_done', 'id_adventure', 'id_student')->withPivot('ended')->withPivot('mistakes')->orderBy('mistakes', 'asc');
    }
    public function modules(){
        return $this->belongsToMany('App\Models\Module', 'adventure_module', 'id_adventure', 'id_module')->withPivot('order')->orderBy('order', 'asc');
    }
    public function teachers(){
        return $this->belongsToMany('App\Models\Teacher', 'teacher_adventure_library', 'id_adventure', 'id_teacher');
    }
}
