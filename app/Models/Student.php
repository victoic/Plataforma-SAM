<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Student
 * @package App\Models
 */
class Student extends Model
{

    public $table = 'students';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'id_user',
        'id_current_adventure',
        'id_current_module',
        'id_current_activity',
        'adventure_ended',
        'id_weakest_module',
        'id_weakest_activity',
        'id_teacher'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_user' => 'integer',
        'id_current_adventure' => 'integer',
        'id_current_module' => 'integer',
        'id_current_activity' => 'integer',
        'adventure_ended' => 'boolean',
        'id_weakest_module' => 'integer',
        'id_weakest_activity' => 'integer',
        'id_teacher' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'id_user');
    }
    public function adventure(){
        return $this->belongsTo('App\Models\Adventure', 'id_current_adventure');
    }
    public function activity(){
        return $this->belongsTo('App\Models\Activity', 'id_current_activity');
    }
    public function module(){
        return $this->belongsTo('App\Models\Module', 'id_current_module');
    }
    public function teacher(){
        return $this->belongsTo('App\Models\Teacher', 'id_teacher');
    }

    public function adventuresDone(){
        return $this->belongsToMany('App\Models\Adventure', 'student_adventure_done', 'id_student', 'id_adventure')->withPivot('ended')->withPivot('mistakes')->orderBy('mistakes', 'desc');
    }
    public function modulesDone(){
        return $this->belongsToMany('App\Models\Module', 'student_module_done', 'id_student', 'id_module')->withPivot('mistakes')->orderBy('mistakes', 'desc');
    }
    public function activitiesDone(){
        return $this->belongsToMany('App\Models\Activity', 'student_activity_done', 'id_student', 'id_activity')->withPivot('mistakes')->withPivot('minTime')->withPivot('maxTime')->orderBy('mistakes', 'desc');
    }
}
