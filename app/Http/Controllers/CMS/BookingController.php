<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Repositories\BookingRepositories;

class BookingController extends Controller
{
    protected $bookingRepo;

    public function __construct(BookingRepositories $bookingRepo)
    {
        $this->bookingRepo = $bookingRepo;
    }

    public function getAllData()
    {
        return $this->bookingRepo->getAllData();
    }

    public function createData(BookingRequest $request)
    {
        return $this->bookingRepo->createData($request);
    }

    public function getDataById($id)
    {
        return $this->bookingRepo->getDataById($id);
    }

    public function updateData(BookingRequest $request, $id)
    {
        return $this->bookingRepo->updateData($request, $id);
    }

    public function deleteData($id)
    {
        return $this->bookingRepo->deleteData($id);
    }
}
