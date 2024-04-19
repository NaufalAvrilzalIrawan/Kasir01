<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DetailPembelianRequest extends FormRequest
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
            'pembelianID' => 'required|integer',
            'produkID' => 'required|integer',
            'jumlah' => 'required|integer',
            'subtotal' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'pembelianID.required' => 'Harus terdapat ID pembelian',
            'pembelianID.integer' => 'ID pembelian harus berupa angka',

            'produkID.required' => 'Harus terdapat ID produk',
            'produkID.integer' => 'ID produk harus berupa angka',

            'jumlah.required' => 'Tolong masukan jumlah yang dibeli',
            'jumlah.integer' => 'Jumlah produk harus berupa angka',

            'subtotal.required' => 'Tidak ada',
            'subtotal.integer' => 'Integer'
        ]; 
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors()));
    }
}
