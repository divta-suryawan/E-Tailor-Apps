<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        if ($this->is('api/v1/auth/updateData/*')) {
            $rules['name'] = 'required';
            $rules['email'] = 'required';
            $rules['password'] = 'confirmed';
            $rules['password_confirmation'] = '';
        } else {
            $rules['name'] = 'required';
            $rules['email'] = 'required';
            $rules['password'] = 'required|confirmed|min:8';
            $rules['password_confirmation'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama user wajib diisi !',
            'email.required' => 'Email wajib diisi !',
            'email.unique' => 'Email sudah ada sebelumnya !',
            'password.required' => 'Password wajib diisi !',
            'password.confirmed' => 'Password konfirmasi harus diisi !',
            'password.min' => 'Panjang karakter minimal 8 !',
            'password_confirmation.required' => 'Password Konfirmasi wajib diisi' 
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
