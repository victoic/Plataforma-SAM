<?php

namespace App\Repositories;

use App\Models\Module;
use InfyOm\Generator\Common\BaseRepository;

class ModuleRepository extends BaseRepository
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
        return Module::class;
    }
}
