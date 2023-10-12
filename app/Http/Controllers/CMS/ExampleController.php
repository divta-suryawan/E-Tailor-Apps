<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Repositories\ExampleRepositories;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    protected $exampleRepositories;

    public function __construct(ExampleRepositories $exampleRepositories)
    {
        $this->exampleRepositories = $exampleRepositories;
    }

    public function getAllData()
    {
        return $this->exampleRepositories->getAllData();
    }
}
