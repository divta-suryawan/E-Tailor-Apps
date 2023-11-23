<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\Login\LoginRequest;
use App\Repositories\AuthRepositories;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authRepositories;

    public function __construct(AuthRepositories $authRepositories)
    {
        $this->authRepositories = $authRepositories;
    }

    public function getAllData()
    {
        return $this->authRepositories->getAllData();
    }

    public function createData(AuthRequest $request)
    {
        return $this->authRepositories->createData($request);
    }

    public function getDataById($id)
    {
        return $this->authRepositories->getDataById($id);
    }

    public function updateData(AuthRequest $request, $id)
    {
        return $this->authRepositories->updateData($request, $id);
    }

    public function deleteData($id)
    {
        return $this->authRepositories->deleteData($id);
    }

    public function login(LoginRequest $request)
    {
        return $this->authRepositories->login($request);
    }

    public function logout(Request $request)
    {
        return $this->authRepositories->logout($request);
    }
}
