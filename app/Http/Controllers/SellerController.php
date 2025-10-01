<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Toko;
use App\Models\VerifikasiToko;
use App\Models\Bumdes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;

class SellerController extends Controller
{
    /**
     * Tampilkan form registrasi seller
     */
    public function create()
    {
        $provinsis = Provinsi::all();
        $user = Auth::user(); // selalu di-pass ke view

        return view('loginRegist.regist.registSeller', compact('provinsis', 'user'));
    }

    /**
     * Proses pendaftaran seller
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_toko' => ['required', 'string', 'max:150', 'unique:toko,nama_toko'],
            'ktp' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'sku' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'nomor_telepon' => ['required', 'string', 'max:20'],
            'id_bumdes' => ['required', 'exists:bumdes,id_bumdes'],
            'id_desa' => ['required', 'exists:desa,id'],
        ]);

        DB::beginTransaction();

        try {
            $user = Auth::user();

            // Upload dokumen
            $ktpPath = $request->file('ktp')->store('dokumen-ktp', 'public');
            $skuPath = $request->file('sku')->store('dokumen-sku', 'public');

            // Buat toko baru
            $toko = Toko::create([
                'id_pengguna' => $user->id_pengguna,
                'nama_toko' => $request->nama_toko,
                'slug_toko' => Str::slug($request->nama_toko),
                'id_bumdes' => $request->id_bumdes,
                'id_desa' => $request->id_desa,
                'kontak'      => $request->kontak,
            ]);

            // Simpan dokumen ke verifikasi toko
            VerifikasiToko::create([
                'id_toko' => $toko->id_toko,
                'dokumen_ktp' => $ktpPath,
                'dokumen_sku' => $skuPath,
                'status_verifikasi' => 'pending',
                'nomor_rekening' => $request->nomor_telepon,
                'email_user' => $user->email,
            ]);

            // === Tambahkan role seller ke user (tanpa hapus role lama) ===
            $sellerRoleId = 2; // contoh: id role seller = 2 (ubah sesuai database kamu)
            if (!$user->roles()->where('pengguna_role.id_role', $sellerRoleId)->exists()) {
                $user->roles()->create([
                    'id_role' => $sellerRoleId
                ]);
            }

            DB::commit();

            return redirect()->route('seller.dashboard')
                ->with('success', 'Toko berhasil dibuat! Menunggu verifikasi.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()
                ->with('error', 'Pembuatan toko gagal: ' . $e->getMessage());
        }
    }

    /**
     * Mendapatkan kabupaten berdasarkan provinsi
     */
    public function getKabupaten($provinsiId)
    {
        $kabupatens = Kabupaten::where('id_provinsi', $provinsiId)->get(['id', 'name']);
        return response()->json($kabupatens);
    }

    /**
     * Mendapatkan kecamatan berdasarkan kabupaten
     */
    public function getKecamatan($kabupatenId)
    {
        $kecamatans = Kecamatan::where('id_kabupaten', $kabupatenId)->get(['id', 'name']);
        return response()->json($kecamatans);
    }

    /**
     * Mendapatkan desa berdasarkan kecamatan
     */
    public function getDesa($kecamatanId)
    {
        $desas = Desa::where('id_kecamatan', $kecamatanId)->get(['id', 'name']);
        return response()->json($desas);
    }

    /**
     * Mendapatkan Bumdes berdasarkan desa
     */
    public function getBumdes($desaId)
    {
        $bumdes = Bumdes::where('id_desa', $desaId)->get(['id_bumdes', 'nama_bumdes']);
        return response()->json($bumdes);
    }
}
