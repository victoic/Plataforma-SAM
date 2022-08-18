<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Title
 * @package App\Models
 */
class Title extends Model
{

    public $table = 'titles';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name',
        'description',
        'points'
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
        'points' => 'integer'
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
        return $this->belongsToMany('App\Models\User', 'user_title', 'id_title', 'id_user');
    }


}
