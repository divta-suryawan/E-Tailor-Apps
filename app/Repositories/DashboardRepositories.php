<?php

namespace App\Repositories;

use App\Http\Requests\BookingRequest;
use App\Interfaces\BookingInterfaces;
use App\Interfaces\DashboardInterfaces;
use App\Models\BookingModel;
use App\Models\ExampleModel;
use App\Models\TailorModel;
use App\Traits\HttpResponseTraits;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardRepositories implements DashboardInterfaces
{
    use HttpResponseTraits;
    protected $tailorModel;
    protected $bokingModel;

    public function __construct(TailorModel $tailorModel, BookingModel $bokingModel)
    {
        $this->tailorModel = $tailorModel;
        $this->bokingModel = $bokingModel;
    }

    public function count()
    {
        $user = Auth::user();
        $id_user = $user->id;
        if ($user->role == 'user') {
            $data = $this->tailorModel::where('id_user', $id_user)->count();
            return $this->success($data);
        } else {
            $data = $this->tailorModel::count();
            return $this->success($data);
        }
    }

    public function countBoking()
    {
        $user = Auth::user();
        $id_user = $user->id;
        if ($user->role == 'user') {
            $data = $this->bokingModel::whereHas('package', function ($query) use ($id_user) {
                $query->where('id_user', $id_user);
            })->count();
            return $this->success($data);
        } else {
            $data = $this->bokingModel::count();
            return $this->success($data);
        }
    }
}
