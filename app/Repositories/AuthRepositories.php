<?php

namespace App\Repositories;

use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\Login\LoginRequest;
use App\Interfaces\AuthInterfaces;
use App\Models\User;
use App\Traits\HttpResponseTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        } else {
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
            } else {
                $data->delete();
            }
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
        return $this->delete();
    }

    public function login(LoginRequest $request)
    {
        try {
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'code' => 401,
                    'message' => 'Login failed'
                ]);
            }

            $user =  $this->userModel::where('email', $request['email'])->first();
            $token = $user->createToken('auth_token')->plainTextToken;
            return $this->success([
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
    }

    public function logout(Request $request)
    {
        $request->user('web')->tokens()->delete();
        Auth::guard('web')->logout();
        return response()->json([
            'message' => 'success logout'
        ]);
    }
}
