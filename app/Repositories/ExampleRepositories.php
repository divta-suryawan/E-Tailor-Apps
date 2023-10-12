<?php

namespace App\Repositories;

use App\Interfaces\ExampleInterfaces;
use App\Models\ExampleModel;
use App\Traits\HttpResponseTraits;

class ExampleRepositories implements ExampleInterfaces
{
    use HttpResponseTraits;
    protected $exampleModel;

    public function __construct(ExampleModel $exampleModel)
    {
        $this->exampleModel = $exampleModel;
    }

    public function getAllData()
    {
        $data = $this->exampleModel::all();
        if ($data->isEmpty()) {
            return $this->dataNotFound();
        } else {
            return $this->success($data);
        }
    }
}
