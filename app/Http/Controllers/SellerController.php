<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSellerRequest;
use App\Models\Toko;
use App\Models\VerifikasiToko;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SellerController extends Controller
{
    public function create()
    {
        return view('loginRegist.regist.registSeller');
    }

    public function store(StoreSellerRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $user = Auth::user();
            $sellerRoleId = 2;

            // Tambahkan role seller tanpa menghapus role lama
            if (!$user->roles()->where('pengguna_role.id_role', $sellerRoleId)->exists()) {
                $user->roles()->create([
                    'id_role' => $sellerRoleId
                ]);
            } // <-- pastikan kurung ditutup di sini

            // Upload file KTP & SKU
            $ktpPath = $request->hasFile('ktp')
                ? $request->file('ktp')->store('uploads/ktp', 'public')
                : null;

            $skuPath = $request->hasFile('sku')
                ? $request->file('sku')->store('uploads/sku', 'public')
                : null;

            // Buat toko baru
            $toko = Toko::create([
                'id_pengguna' => $user->id_pengguna,
                'nama_toko' => $data['nama_toko'],
                'slug_toko' => Str::slug($data['nama_toko']),
                'terverifikasi' => 'pending',
                'nomor_rekening' => $data['nomor_rekening'] ?? $user->nomor_rekening,
                'id_desa' => $data['id_desa'] ?? $user->id_desa,
            ]);

            // Simpan dokumen ke tabel verifikasi_toko
            VerifikasiToko::create([
                'id_toko' => $toko->id_toko,
                'status_verifikasi' => 'pending',
                'dokumen_ktp' => $ktpPath,
                'dokumen_sku' => $skuPath,
                'nomor_rekening' => $toko->nomor_rekening,
                'email_user' => $user->email,
            ]);

            DB::commit();

            return redirect()->route('seller.dashboard')
                ->with('success', 'Toko berhasil dibuat! Menunggu verifikasi.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()
                ->with('error', 'Pembuatan toko gagal: ' . $e->getMessage());
        }
    }
}