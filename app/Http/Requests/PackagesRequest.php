<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PackagesRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'package_name' => 'required',
            'package_price' => 'required|numeric',
            'description' => 'required',
            'id_tailor' => 'required',
        ];
        if ($this->is('api/v1/packages/update/*')) {
            $rules['package_name'] = 'required';
            $rules['package_price'] = 'required|numeric';
            $rules['package_image'] = 'mimes:png,jpg,jpeg';
            $rules['description'] = 'required';
            $rules['id_tailor'] = 'required';
        } else {
            $rules['package_name'] = 'required';
            $rules['package_price'] = 'required|numeric';
            $rules['address'] = 'required';
            $rules['package_image'] = 'required|mimes:png,jpg,jpeg';
            $rules['description'] = 'required';
            $rules['id_tailor'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'package_name.required' => 'Form nama paket harus diisi.',
            'package_price.required' => 'Form harga paket harus diisi.',
            'package_price.numeric' => 'Form harga paket harus berupa angkat.',
            'description.required' => 'Form deskripsi  harus disisi',
            'package_image.required' => 'Fomr gambar paket wajib diisi',
            'package_image.mimes' => 'Format harus png,jpg,jpeg',
            'id_tailor.required' => 'Form toko tailor wajib diisi.',
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
