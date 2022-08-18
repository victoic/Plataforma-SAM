<?php

namespace App\Repositories;

use App\Models\Adventure;
use InfyOm\Generator\Common\BaseRepository;

class AdventureRepository extends BaseRepository
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
        return Adventure::class;
    }
}
