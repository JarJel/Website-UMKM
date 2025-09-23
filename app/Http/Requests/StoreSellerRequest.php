<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSellerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_pengguna' => 'required|string|max:255',
            'nama_lengkap' => 'nullable|string|max:255',
            'nomor_telepon' => 'nullable|string|max:20',
            'nama_toko' => 'required|string|max:255',
            'kata_sandi' => 'required|string|min:6|confirmed', // kata_sandi + kata_sandi_confirmation
            'nomor_rekening' => 'nullable|string|max:50', // <-- ditambahkan
            'ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'sku' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }

}
