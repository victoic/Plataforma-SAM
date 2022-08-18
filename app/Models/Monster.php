<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Monster
 * @package App\Models
 */
class Monster extends Model
{

    public $table = 'monsters';

    public $fillable = [
        'name',
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
        'icon' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
