<?php

namespace App\Repositories;

use App\Models\Alternative;
use InfyOm\Generator\Common\BaseRepository;

class AlternativeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Alternative::class;
    }
}
