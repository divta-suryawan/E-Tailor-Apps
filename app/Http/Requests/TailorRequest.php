<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TailorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        if ($this->is('api/v1/tailor/update/*')) {
            $rules['tailor_name'] = 'required';
            $rules['email'] = 'required';
            $rules['address'] = 'required';
            $rules['phone'] = 'required';
            $rules['tailor_img'] = 'mimes:png,jpg,jpeg';
            $rules['description'] = 'required';
           
        } else {
            $rules['tailor_name'] = 'required';
            $rules['email'] = 'required|email';
            $rules['address'] = 'required';
            $rules['phone'] = 'required';
            $rules['tailor_img'] = 'required|mimes:png,jpg,jpeg';
            $rules['description'] = 'required';
        }
    
        return $rules;
    }
    

    public function messages()
    {
        return [
            'tailor_name.required' => 'Nama toko wajib diisi !',
            'address.required' => 'Alamat wajib diisi !',
            'phone.required' => 'Nomor handphone wajib diisi !',
            'phone.numeric' => 'Format harus angka',
            'email.required' => 'Email wajib diisi !',
            'email.email' => 'format harus email',
            'tailor_img.required' => 'Gambar toko wajib diisi !',
            'tailor.mimes' => 'Format harus png,jpg,jpeg',
            'description.required' => 'Deskripsi tidak boleh kosong !   '
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'code' => 422,
            'message' => 'Check your validation',
            'errors' => $validator->errors()->first()
        ]));
    }
}
