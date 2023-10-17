<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\TailorRequest;
use App\Repositories\TailorRepositories;
use Illuminate\Http\Request;

class TailorController extends Controller
{
    protected $tailorRepostories;

    public function __construct(TailorRepositories $tailorRepositories)
    {
        $this->tailorRepostories = $tailorRepositories;
    }

    public function getAllData()
    {
        return $this->tailorRepostories->getAllData();
    }

    public function createData(TailorRequest $request)
    {
        return $this->tailorRepostories->createData($request);
    }

    public function getDataById($id)
    {
        return $this->tailorRepostories->getDataById($id);
    }

    public function updateData(TailorRequest $request, $id)
    {
        return $this->tailorRepostories->updateData($request , $id);
    }

    public function deleteData($id)
    {
        return $this->tailorRepostories->deleteData($id);
    }
}
