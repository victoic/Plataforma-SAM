<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Contact
 * @package App\Models
 */
class Contact extends Model
{

    public $table = 'contacts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'message',
        'id_user'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'message' => 'string',
        'id_user' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
