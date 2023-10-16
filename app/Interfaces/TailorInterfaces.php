<?php

namespace App\Interfaces;

use App\Http\Requests\TailorRequest;

interface TailorInterfaces {
    public function getAllData();
    public function createData(TailorRequest $request);
    public function getDataById($id);
    public function updateData(TailorRequest $request, $id);
}