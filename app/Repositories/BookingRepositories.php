<?php

namespace App\Repositories;

use App\Http\Requests\BookingRequest;
use App\Interfaces\BookingInterfaces;
use App\Models\BookingModel;
use App\Models\ExampleModel;
use App\Traits\HttpResponseTraits;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingRepositories implements BookingInterfaces
{
    use HttpResponseTraits;
    protected $bookingModel;

    public function __construct(BookingModel $bookingModel)
    {
        $this->bookingModel = $bookingModel;
    }

    public function getAllData()
    {
        $user = Auth::user();
        $id_user = $user->id;
        if ($user->role == 'user') {
            $data = $this->bookingModel::with('package')->whereHas('package', function ($query) use ($id_user) {
                $query->where('id_user', $id_user);
            })->get();
            return $this->success($data);
        } else {
            $data = $this->bookingModel::with('package')->get();
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
