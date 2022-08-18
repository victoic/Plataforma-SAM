<?php

namespace App\Models;

use App\Models\Adventure;
use Eloquent as Model;

/**
 * Class User
 * @package App\Models
 */
class User extends Model
{
    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name',
        'birth_date',
        'active_time',
        'email',
        'teacher',
        'password',
        'points',
        'remember_token',
        'id_adventure',
        'id_unlocked_activity',
        'id_unlocked_module'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'birth_date' => 'date',
        'email' => 'string',
        'teacher' => 'boolean',
        'password' => 'string',
        'points' => 'integer',
        'remember_token' => 'string',
        'id_adventure' => 'integer',
        'id_unlocked_activity' => 'integer',
        'id_unlocked_module' => 'integer'
    ];

    protected $dates = ['created_at', 'updated_at', 'birth_date'];

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
    public function achievements(){
        return $this->belongsToMany('App\Models\Achievement', 'user_achievement', 'id_user', 'id_achievement');
    }
    public function titles(){
        return $this->belongsToMany('App\Models\Title', 'user_title', 'id_user', 'id_title');
    }
    public function activeTitle(){
        return $this->hasOne('App\Models\Title', 'id', 'id_active_title');
    }
    public function activeAchievement(){
        return $this->hasOne('App\Models\Achievement', 'id', 'id_active_achievement');
    }
    public function myStudent(){
        return $this->hasOne('App\Models\Student', 'id', 'id_student');
    }
    public function myTeacher(){
        return $this->hasOne('App\Models\Teacher', 'id', 'id_teacher');
    }
}
