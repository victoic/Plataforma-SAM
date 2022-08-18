<?php

namespace App\Repositories;

use App\Models\Achievement;
use InfyOm\Generator\Common\BaseRepository;

class AchievementRepository extends BaseRepository
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
        return Achievement::class;
    }
}
