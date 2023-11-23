<?php

namespace App\Interfaces;

use App\Http\Requests\Auth\AuthRequest;

interface AuthInterfaces {
    public function getAllData();
    public function createData(AuthRequest $request);
    public function getDataById($id);
    public function updateData(AuthRequest $request, $id);
    public function deleteData($id);
}