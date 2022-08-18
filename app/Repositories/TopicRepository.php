<?php

namespace App\Repositories;

use App\Models\Topic;
use InfyOm\Generator\Common\BaseRepository;

class TopicRepository extends BaseRepository
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
        return Topic::class;
    }
}
