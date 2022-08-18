<?php

namespace App\Repositories;

use App\Models\Title;
use InfyOm\Generator\Common\BaseRepository;

class TitleRepository extends BaseRepository
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
        return Title::class;
    }
}
