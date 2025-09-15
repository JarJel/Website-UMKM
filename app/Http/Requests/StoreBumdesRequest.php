<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBumdesRequest extends FormRequest
{
    /**
     * Tentukan apakah user berhak membuat request ini.
     */
    public function authorize(): bool
    {
        return true; // ubah sesuai kebutuhan misalnya pakai Gate atau Policy
    }

    /**
     * Aturan validasi untuk request.
     */
    public function rules(): array
    {
        return [
            'nama_bumdes'      => 'required|string|max:255',
            'kata_sandi'       => 'required|string|min:6',
            'deskripsi'        => 'nullable|string',
            'alamat_bumdes'    => 'nullable|string|max:255',
            'nomor_telepon'    => 'nullable|string|max:20',
            'email'            => 'required|email|unique:bumdes,email',
            'logo'             => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nomor_rekening'   => 'nullable|string|max:50',
        ];
    }

    /**
     * Pesan error custom.
     */
    public function messages(): array
    {
        return [
            'nama_bumdes.required' => 'Nama BUMDes wajib diisi.',
            'kata_sandi.required'  => 'Kata sandi wajib diisi.',
            'kata_sandi.min'       => 'Kata sandi minimal 6 karakter.',
            'email.required'       => 'Email wajib diisi.',
            'email.email'          => 'Format email tidak valid.',
            'email.unique'         => 'Email sudah terdaftar.',
            'logo.image'           => 'Logo harus berupa gambar.',
            'logo.mimes'           => 'Format logo harus jpeg, png, jpg, gif, atau svg.',
            'logo.max'             => 'Ukuran logo maksimal 2MB.',
        ];
    }
}
