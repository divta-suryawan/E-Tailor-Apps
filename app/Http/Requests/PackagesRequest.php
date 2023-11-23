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
    }

    public function messages()
    {
        return [
            'package_name.required' => 'Form nama paket harus diisi.',
            'package_price.required' => 'Form harga paket harus diisi.',
            'package_price.numeric' => 'Form harga paket harus berupa angkat.',
            'description.required' => 'Form deskripsi  harus disisi',
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
