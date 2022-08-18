<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Teacher
 * @package App\Models
 */
class Teacher extends Model
{

    public $table = 'teachers';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'id_user'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_user' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'id_user', 'id');
    }
    public function students(){
        return $this->hasMany('App\Models\Student', 'id_teacher', 'id');
    }
    public function createdAdventures(){
        return $this->hasMany('App\Models\Adventure', 'id_creator', 'id');
    }
     public function createdActivities(){
        return $this->hasMany('App\Models\Activity', 'id_creator', 'id');
    }
    public function createdModules(){
        return $this->hasMany('App\Models\Module', 'id_creator', 'id');
    }
    public function adventuresInLibrary(){
        return $this->belongsToMany('App\Models\Adventure', 'teacher_adventure_library', 'id_teacher', 'id_adventure');
    }
}
