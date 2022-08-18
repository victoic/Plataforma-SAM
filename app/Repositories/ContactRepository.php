<?php

namespace App\Repositories;

use App\Models\Contact;
use InfyOm\Generator\Common\BaseRepository;

class ContactRepository extends BaseRepository
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
        return Contact::class;
    }
}
