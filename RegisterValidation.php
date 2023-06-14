<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterValidation extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nama_pengguna' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'nama_pengguna.required' => 'Sila Masukkan Nama Penuh !',

            'email.required' => 'Sila Masukkan Email !',
            'email.email' => 'Sila Masukkan Email Yang Sah !',
            'email.unique' => 'Email Telah Didaftarkan !',

            'password.numeric' => 'Sila Masukkan Kata Laluan Nombor Sahaja !',
        ];
    }
}
