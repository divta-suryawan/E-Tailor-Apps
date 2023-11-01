<?php

namespace App\Repositories;

use App\Http\Requests\BookingRequest;
use App\Interfaces\BookingInterfaces;
use App\Models\BookingModel;
use App\Models\ExampleModel;
use App\Traits\HttpResponseTraits;
use Carbon\Carbon;

class BookingRepositories implements BookingInterfaces
{
    use HttpResponseTraits;
    protected $exampleModel;
    protected $bookingModel;

    public function __construct(ExampleModel $exampleModel, BookingModel $bookingModel)
    {
        $this->exampleModel = $exampleModel;
        $this->bookingModel = $bookingModel;
    }

    public function getAllData()
    {
        $data = $this->bookingModel::with('package')->get();
        if ($data->isEmpty()) {
            return $this->dataNotFound();
        } else {
            return $this->success($data);
        }
    }

    public function createData(BookingRequest $request)
    {
        try {
            $data = new $this->bookingModel;
            $data->customer_name = $request->input('customer_name');
            $data->phone_number = $request->input('phone_number');
            $data->booking_date = Carbon::now('Asia/Makassar');
            $data->appointment_date = $request->input('appointment_date');
            $data->id_package = $request->input('id_package');
            $data->save();
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
        return $this->success($data);
    }

    public function getDataById($id)
    {
        $data = $this->bookingModel::where('id', $id)->first();
        if (!$data) {
            return $this->idOrDataNotFound();
        } else {
            return $this->success($data);
        }
    }

    public function updateData(BookingRequest $request, $id)
    {
        try {
            $data = $this->bookingModel::where('id', $id)->first();
            $data->customer_name = $request->input('customer_name');
            $data->phone_number = $request->input('phone_number');
            $data->booking_date = Carbon::now('Asia/Makassar');
            $data->appointment_date = $request->input('appointment_date');
            $data->id_package = $request->input('id_package');
            $data->save();
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
        return $this->success($data);
    }

    public function deleteData($id)
    {
        $data = $this->bookingModel::where('id', $id)->first();
        if (!$data) {
            return $this->idOrDataNotFound();
        } else {
            $data->delete();
            return $this->delete();
        }
    }
}
