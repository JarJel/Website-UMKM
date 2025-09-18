<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreSellerRequest;
use App\Models\User;
use App\Models\Toko;
use App\Models\VerifikasiToko;
use Illuminate\Support\Facades\DB;
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

            // Upload file KTP dan SKU
            $ktpPath = $request->hasFile('ktp') ? $request->file('ktp')->store('uploads/ktp', 'public') : null;
            $skuPath = $request->hasFile('sku') ? $request->file('sku')->store('uploads/sku', 'public') : null;

            // 1️⃣ Simpan ke tabel pengguna
            $user = User::create([
                'nama_lengkap' => $data['nama_lengkap'],
                'nama_pengguna' => $data['nama_pengguna'],
                'email' => $data['email'],
                'kata_sandi' => bcrypt($data['kata_sandi']),
                'id_role' => 2,
                'ktp' => $ktpPath,
                'sku' => $skuPath,
                'no_rekening' => $data['nomor_rekening'] ?? null,
                'id_desa' => $data['id_desa'] ?? null
            ]);

            // 2️⃣ Simpan ke tabel toko
            $toko = Toko::create([
                'id_pengguna' => $user->id_pengguna,
                'nama_toko' => $data['nama_toko'],
                'slug_toko' => Str::slug($data['nama_toko']),
                'status_verifikasi' => 'pending',
                'nomor_rekening' => $data['nomor_rekening'] ?? null,
                'id_desa' => $data['id_desa'] ?? null
            ]);

            // 3️⃣ Simpan ke tabel verifikasi_toko
            VerifikasiToko::create([
                'id_toko' => $toko->id_toko,
                'status_verifikasi' => 'pending',
                'dokumen_ktp' => $ktpPath,
                'dokumen_sku' => $skuPath,
                'nomor_rekening' => $data['nomor_rekening'] ?? null
            ]);

            DB::commit();

            return redirect()->route('seller.dashboard')
                ->with('success', 'Registrasi berhasil! Menunggu verifikasi toko.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Registrasi gagal: ' . $e->getMessage());
        }
    }
}
