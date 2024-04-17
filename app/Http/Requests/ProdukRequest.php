<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdukRequest extends FormRequest
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
            'namaProduk' => 'required|string',
            'harga' => 'nullable|integer',
            'stok' => 'nullable|integer'
        ];
    }

    public function messages() {
        return [
            'namaProduk.required' => 'Produk harus memiliki nama',
            'namaProduk.string' => 'Nama produk harus berupa huruf',
            'harga.integer' => 'Harga harus berupa angka',
            'stok.integer' => 'stok harus berupa angka'
        ];
    }

    protected function failedValidation(Validator $validator) {

        throw new HttpResponseException(response()->json($validator->errors(),422));
    }
}
