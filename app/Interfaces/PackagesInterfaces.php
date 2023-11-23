<?php

namespace App\Interfaces;

use App\Http\Requests\PackagesRequest;

interface PackagesInterfaces
{
    public function getAllData();
    public function getAllDataByTailor();
    public function getDataPacketByTailor($id_tailor);
    public function createData(PackagesRequest $request);
    public function getDataById($id);
    public function updateData(PackagesRequest $request, $id);
    public function deleteData($id);
}
