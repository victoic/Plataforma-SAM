<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Alternative
 * @package App\Models
 */
class Alternative extends Model
{

    public $table = 'alternatives';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'text',
        'right',
        'id_exercise'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'text' => 'string',
        'right' => 'boolean',
        'id_exercise' => 'integer'
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
    public function exercise(){
        return $this->belongsTo('App\Models\Exercise', 'id', 'id_exercise');
    }
}
