<?php

namespace App\Repositories;

use App\Http\Requests\PackagesRequest;
use App\Interfaces\PackagesInterfaces;
use App\Models\PackagesModel;
use App\Traits\HttpResponseTraits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
    public function getAllDataByTailor()
    {
        $user = Auth::user();
        if ($user->role == 'user') {
            $data = $this->packagesModel::with('tailor')->where('id_user', $user->id)->get();
            return $this->success($data);
        } else {
            $data = $this->packagesModel::with('tailor')->get();
            return $this->success($data);
        }
    }

    public function getDataPacketByTailor($id_tailor)
    {
        $data = $this->packagesModel::where('id_tailor', $id_tailor)->get();
        if (!$data) {
            return $this->idOrDataNotFound();
        } else {
            return $this->success($data);
        };
    }

    public function createData(PackagesRequest $request)
    {
        try {
            $user = Auth::user();
            $data = new $this->packagesModel;
            $data->package_name = $request->input('package_name');
            $data->package_price = $request->input('package_price');
            $data->description = $request->input('description');
            $data->id_tailor = $request->input('id_tailor');
            $data->id_user = $user->id;
            if ($request->hasFile('package_image')) {
                $file = $request->file('package_image');
                $extention = $file->getClientOriginalExtension();
                $filename = 'PACKET-' . Str::random(15) . '.' . $extention;
                Storage::makeDirectory('uploads/packages');
                $file->move(public_path('uploads/packages'), $filename);
                $data->package_image = $filename;
            }
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
            $data->package_name = $request->input('package_name');
            $data->package_price = $request->input('package_price');
            $data->description = $request->input('description');
            if ($request->hasFile('package_image')) {
                $file = $request->file('package_image');
                $extention = $file->getClientOriginalExtension();
                $filename = 'PACKET-' . Str::random(15) . '.' . $extention;
                Storage::makeDirectory('uploads/packages');
                $file->move(public_path('uploads/packages'), $filename);
                $old_file  = public_path('uploads/packages') . $data->package_image;
                if (file_exists($old_file)) {
                    unlink($old_file);
                }
                $data->package_image = $filename;
            }
            $data->id_tailor = $request->input('id_tailor');
            $data->save();
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
        return $this->success($data);
    }

    public function deleteData($id)
    {
        $data = $this->packagesModel::where('id', $id)->first();
        if (!$data) {
            return $this->idOrDataNotFound();
        } else {
            $location = 'uploads/packages/' . $data->package_image;
            $data->delete();
            if (File::exists($location)) {
                File::delete($location);
            }
        }

        return $this->delete();
    }
}
