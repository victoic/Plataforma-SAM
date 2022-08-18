<?php

namespace App\Repositories;

use App\Models\Teacher;
use InfyOm\Generator\Common\BaseRepository;

class TeacherRepository extends BaseRepository
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
        return Teacher::class;
    }
}
