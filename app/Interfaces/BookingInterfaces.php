<?php

namespace App\Interfaces;

use App\Http\Requests\BookingRequest;

interface BookingInterfaces
{
    public function getAllData();
    public function createData(BookingRequest $request);
    public function getDataById($id);
    public function updateData(BookingRequest $request, $id);
    public function deleteData($id);
}
