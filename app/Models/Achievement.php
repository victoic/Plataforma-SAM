<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Achievement
 * @package App\Models
 */
class Achievement extends Model
{

    public $table = 'achievements';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name',
        'description',
        'points',
        'icon'
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
        'points' => 'integer',
        'icon' => 'string'
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
    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
}
