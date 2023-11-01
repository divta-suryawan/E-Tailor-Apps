<?php

namespace App\Repositories;

use App\Interfaces\ExampleInterfaces;
use App\Models\ExampleModel;
use App\Models\TailorModel;
use App\Traits\HttpResponseTraits;

class ExampleRepositories implements ExampleInterfaces
{
    use HttpResponseTraits;
    protected $exampleModel;
    protected $tailorModel;

    public function __construct(ExampleModel $exampleModel, TailorModel $tailorModel)
    {
        $this->exampleModel = $exampleModel;
        $this->tailorModel = $tailorModel;
    }

    public function getAllData()
    {
        $data = $this->exampleModel::with('tailor')->get();
        if ($data->isEmpty()) {
            return $this->dataNotFound();
        } else {
            return $this->success($data);
        }
    }
}
