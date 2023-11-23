<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BookingRequest extends FormRequest
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
        return [
            'customer_name' => 'required',
            'phone_number' => 'required',
            'appointment_date' => 'required',
            'id_package' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'customer_name.required' => 'Form nama customer tidak boleh kosong',
            'phone_number.required' => 'Form nomor hp tidak boleh kosong',
            'appointment_date.required' => 'Form tanggal janji temu tidak boleh kosong',
            'id_package.required' => 'Form paket tidak boleh kosong',
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
