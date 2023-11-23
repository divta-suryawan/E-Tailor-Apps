<?php

namespace App\Repositories;

use App\Http\Requests\Auth\AuthRequest;
use App\Interfaces\AuthInterfaces;
use App\Models\User;
use App\Traits\HttpResponseTraits;
use Illuminate\Support\Facades\Hash;

class AuthRepositories implements AuthInterfaces
{
    use HttpResponseTraits;
    protected $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function getAllData()
    {
        $data = $this->userModel::all();
        if ($data->isEmpty()) {
            return $this->dataNotFound();
        } else {
            return $this->success($data);
        }
    }

    public function createData(AuthRequest $request)
    {
        try {
            $role = 'user';
            $data = new $this->userModel;
            $data->name = $request->input('name');
            $data->email = $request->input('email');
            $data->role = $role;
            $data->password = Hash::make($request->input('password'));
            $data->save();
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
        return $this->success($data);
    }

    public function getDataById($id)
    {
        $data = $this->userModel::find($id);
        if (!$data) {
            return $this->idOrDataNotFound();
        }else{
            return $this->success($data);
        }
    }

    public function updateData(AuthRequest $request, $id)
    {
        try {
            $data = $this->userModel::find($id);
            $data->name = $request->input('name');
            $data->email = $request->input('email');
            if ($request->has('password')) {
                $data->password = Hash::make($request->input('password'));
            }
            $data->save();
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
        return $this->success($data);
    }

    public function deleteData($id)
    {
        try {
            $data = $this->userModel::find($id);
            if (!$data) {
                return $this->idOrDataNotFound();
            }else{
                $data->delete();
            }
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
        return $this->delete();
    }

}
