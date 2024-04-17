<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
            'nama' => 'required|string',
            'password' => 'required|string|min:8',
            'email' => 'required|email',
            'role' => 'required|integer|max:2',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:15'
        ];
    }

    public function messages() {
        return [
            'nama.required' => 'Nama harus terisi',
            'nama.string' => 'Nama harus berupa karakter',

            'password.required' => 'Password harus terisi',
            'password.string' => 'Password harus berupa karakter',
            'password.min' => 'Password setidaknya :min karakter',

            'email.required' => 'Email harus terisi',
            'email.email' => 'Format email salah',

            'role.required' => 'Role harus terisi',
            'role.integer' => 'Mohon masukan role yang benar',
            'role.max' => 'Role tidak lebih dari 10',

            'alamat.required' => 'Alamat harus terisi',
            'alamat.string' => 'Alamat harus berupa karakter',

            'telepon.required' => 'Nomor telepon harus terisi',
            'telepon.string' => 'Nomor telepon harus berupa karakter',
            'telepon.max' => 'Nomor telepon harus terdiri dari :max karakter',
        ];
    }

    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json($validator->errors(),422));
    }
}
