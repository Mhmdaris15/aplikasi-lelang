<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHistoryLelangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (auth()->user()->role === 'admin' || auth()->user()->role === 'petugas' || auth()->user()->role === 'user') {
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
            //
            "penawaran_harga" => ['required', 'numeric'],
            "id_lelang" => ['required', 'exists:lelangs,id'],
            "id_user" => ['required', 'exists:users,id'],
            "id_barang" => ['required', 'exists:barangs,id'],
        ];
    }
}
