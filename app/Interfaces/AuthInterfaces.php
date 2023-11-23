<?php

namespace App\Interfaces;

use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\Login\LoginRequest;
use Illuminate\Http\Request;

interface AuthInterfaces {
    public function getAllData();
    public function createData(AuthRequest $request);
    public function getDataById($id);
    public function updateData(AuthRequest $request, $id);
    public function deleteData($id);
    public function login(LoginRequest $request);
    public function logout(Request $request);
}