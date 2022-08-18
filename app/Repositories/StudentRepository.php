<?php

namespace App\Repositories;

use App\Models\Student;
use InfyOm\Generator\Common\BaseRepository;

class StudentRepository extends BaseRepository
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
        return Student::class;
    }
}
