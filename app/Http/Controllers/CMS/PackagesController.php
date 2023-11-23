<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackagesRequest;
use App\Repositories\PackagesRepositories;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    protected $packagesRepo;

    public function __construct(PackagesRepositories $packagesRepo)
    {
        $this->packagesRepo = $packagesRepo;
    }
    public function getAllData()
    {
        return $this->packagesRepo->getAllData();
    }

    public function getDataPacketByTailor($id_tailor)
    {
        return $this->packagesRepo->getDataPacketByTailor($id_tailor);
    }

    public function getDataByTailor()
    {
        return $this->packagesRepo->getAllDataByTailor();
    }

    public function createData(PackagesRequest $request)
    {
        return $this->packagesRepo->createData($request);
    }
    public function getDataById($id)
    {
        return $this->packagesRepo->getDataById($id);
    }
    public function updateData(PackagesRequest $request, $id)
    {
        return $this->packagesRepo->updateData($request, $id);
    }
    public function deleteData($id)
    {
        return $this->packagesRepo->deleteData($id);
    }
}
