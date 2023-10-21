<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLelangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->user()->role == 'admin' || $this->user()->role == 'petugas') {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_barang' => 'required',
            'id_user' => 'required',
            'id_petugas' => 'required',
            'tanggal' => 'required',
            'harga_akhir' => 'required',
            'status' => 'required',
        ];
    }
}