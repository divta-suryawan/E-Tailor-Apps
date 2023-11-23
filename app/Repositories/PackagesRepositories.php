<?php

namespace App\Repositories;

use App\Http\Requests\PackagesRequest;
use App\Interfaces\PackagesInterfaces;
use App\Models\PackagesModel;
use App\Traits\HttpResponseTraits;

class PackagesRepositories implements PackagesInterfaces
{
    use HttpResponseTraits;
    protected $packagesModel;
    public function __construct(PackagesModel $packagesModel)
    {
        return $this->packagesModel = $packagesModel;
    }
    public function getAllData()
    {
        $data = $this->packagesModel::with('tailor')->get();
        if ($data->isEmpty()) {
            return $this->dataNotFound();
        } else {
            return $this->success($data);
        }
    }
    public function createData(PackagesRequest $request)
    {
        try {
            $data = new $this->packagesModel;
            $data->package_name = htmlspecialchars($request->input('package_name'));
            $data->package_price = htmlspecialchars($request->input('package_price'));
            $data->description = htmlspecialchars($request->input('description'));
            $data->id_tailor = htmlspecialchars($request->input('id_tailor'));
            $data->save();
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
        return $this->success($data);
    }

    public function getDataById($id)
    {
        $data = $this->packagesModel::where('id', $id)->first();
        if (!$data) {
            return $this->idOrDataNotFound();
        } else {
            return $this->success($data);
        };
    }
    public function updateData(PackagesRequest $request, $id)
    {
        try {
            $data = $this->packagesModel::where('id', $id)->first();
            $data->package_name = htmlspecialchars($request->input('package_name'));
            $data->package_price = htmlspecialchars($request->input('package_price'));
            $data->description = htmlspecialchars($request->input('description'));
            $data->id_tailor = htmlspecialchars($request->input('id_tailor'));
            $data->save();
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
        return $this->success($data);
    }

    public function deleteData($id)
    {
        try {
            $data = $this->packagesModel::where('id', $id)->first();
            $data->delete();
            return $this->delete();
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
    }
}
