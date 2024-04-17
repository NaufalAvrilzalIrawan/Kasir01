<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MemberRequest extends FormRequest
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
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:15'
        ];
    }

    public function messages() {
        return [
            'nama.required' => 'Nama harus terisi',
            'alamat.required' => 'Alamat harus terisi',
            'telepon.required' => 'Nomor telepon harus terisi',
            'telepon.max' => 'Nomor telepon tidak boleh melebihi :max karakter'
        ];
    }

    protected function failedValidation(Validator $validator) {

        throw new HttpResponseException(response()->json($validator->errors(),422));
    }
}
