<?php

namespace App\Repositories;

use App\Http\Requests\TailorRequest;
use App\Interfaces\TailorInterfaces;
use App\Models\TailorModel;
use App\Traits\HttpResponseTraits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TailorRepositories implements TailorInterfaces
{
    use HttpResponseTraits;
    protected $tailorModel;

    public function __construct(TailorModel $tailorModel)
    {
        $this->tailorModel = $tailorModel;
    }

    public function getAllData()
    {
        $user = Auth::user();
        if ($user->role == 'user') {
            $data = $this->tailorModel::where('id_user' , $user->id)->get();
            return $this->success($data);
        }else{
            $data = $this->tailorModel::all();
            return $this->success($data);
        }
    }

    public function createData(TailorRequest $request)
    {
        try {
            $data = new $this->tailorModel;
            $user = Auth::user();
            $data->tailor_name = htmlspecialchars($request->input('tailor_name'));
            $data->address = htmlspecialchars($request->input('address'));
            $data->phone = htmlspecialchars($request->input('phone'));
            $data->email = htmlspecialchars($request->input('email'));
            $data->id_user = $user->id;
            if ($request->hasFile('tailor_img')) {
                $file = $request->file('tailor_img');
                $extention = $file->getClientOriginalExtension();
                $filename = 'TAILOR-' . Str::random(15) . '.' . $extention;
                Storage::makeDirectory('uploads/tailor');
                $file->move(public_path('uploads/tailor'), $filename);
                $data->tailor_img = $filename;
            }
            $data->description = $request->input('description');
            $data->save();
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }

        return $this->success($data);
    }

    public function getDataById($id)
    {
        $data = $this->tailorModel::where('id', $id)->first();
        if (!$data) {
            return $this->idOrDataNotFound();
        } else {
            return $this->success($data);
        };
    }

    public function updateData(TailorRequest $request, $id)
    {
        try {
            $data = $this->tailorModel::where('id', $id)->first();
            $data->tailor_name = htmlspecialchars($request->input('tailor_name'));
            $data->address = htmlspecialchars($request->input('address'));
            $data->phone = htmlspecialchars($request->input('phone'));
            $data->email = htmlspecialchars($request->input('email'));
            if ($request->hasFile('tailor_img')) {
                $file = $request->file('tailor_img');
                $extention = $file->getClientOriginalExtension();
                $filename = 'TAILOR-' . Str::random(15) . '.' . $extention;
                Storage::makeDirectory('uploads/tailor');
                $file->move(public_path('uploads/tailor'), $filename);
                $old_file  = public_path('uploads/tailor') . $data->tailor_img;
                if (file_exists($old_file)) {
                    unlink($old_file);
                }
                $data->tailor_img = $filename;
            }
            $data->description = $request->input('description');
            $data->save();
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }

        return $this->success($data);
    }

    public function deleteData($id)
    {
        $data = $this->tailorModel::where('id', $id)->first();
        if (!$data) {
            return $this->idOrDataNotFound();
        } else {
            $location = 'uploads/tailor/' . $data->tailor_img;
            $data->delete();
            if (File::exists($location)) {
                File::delete($location);
            }
        }

        return $this->delete();
    }
}
