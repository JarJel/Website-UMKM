<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Bumdes;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // TAMBAHKAN INI

class KelolaBumdesController extends Controller
{
    public function kelolaBumdes()
    {
        $provinsis = Provinsi::all();
        $kategoris = Kategori::all();

        // Debug: Cek data provinsi
        Log::info('Provinsi data:', ['count' => $provinsis->count(), 'data' => $provinsis->toArray()]);

        return view('backend.superadmin.kelola-bumdes', compact('provinsis', 'kategoris'));
    }

    public function storeBumdes(Request $request)
    {
        $validated = $request->validate([
            'nama_pengguna' => 'required|string|max:255|unique:pengguna,nama_pengguna',
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pengguna,email',
            'password' => 'required|string|min:8|confirmed',
            'nama_bumdes' => 'required|string|max:255',
            'id_provinsi' => 'required|integer|exists:provinsi,id_provinsi',
            'id_kabupaten' => 'required|integer|exists:kabupaten,id_kabupaten',
            'id_kecamatan' => 'required|integer|exists:kecamatan,id_kecamatan',
            'id_desa' => 'required|integer|exists:desa,id_desa',
        ]);

        DB::beginTransaction();
        try {
            $pengguna = User::create([
                'nama_lengkap' => $validated['nama_lengkap'],
                'nama_pengguna' => $validated['nama_pengguna'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'Bumdes',
                'is_verified' => true,
            ]);

            Bumdes::create([
                'nama_bumdes' => $validated['nama_bumdes'],
                'id_pengguna' => $pengguna->id_pengguna,
                'id_desa' => $validated['id_desa'],
                'id_kecamatan' => $validated['id_kecamatan'],
                'id_kabupaten' => $validated['id_kabupaten'],
                'id_provinsi' => $validated['id_provinsi'],
            ]);

            DB::commit();
            return back()->with('success', 'Akun BUMDES berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating BUMDES account', ['error' => $e->getMessage()]);
            return back()->with('error', 'Gagal menambahkan akun BUMDES: ' . $e->getMessage());
        }
    }

    // ===================== AJAX =====================

    public function getKabupaten($id_provinsi)
    {
        try {
            $kabupaten = Kabupaten::where('id_provinsi', $id_provinsi)
                ->select('id_kabupaten as id', 'nama_kabupaten as nama')
                ->orderBy('nama_kabupaten', 'asc')
                ->get();
            
            Log::info('Kabupaten loaded for provinsi', ['provinsi_id' => $id_provinsi, 'count' => $kabupaten->count()]);
            
            return response()->json($kabupaten);
        } catch (\Exception $e) {
            Log::error('Error loading kabupaten', ['provinsi_id' => $id_provinsi, 'error' => $e->getMessage()]);
            return response()->json(['error' => 'Gagal memuat data kabupaten'], 500);
        }
    }

    public function getKecamatan($id_kabupaten)
    {
        try {
            $kecamatan = Kecamatan::where('id_kabupaten', $id_kabupaten)
                ->select('id_kecamatan as id', 'nama_kecamatan as nama')
                ->orderBy('nama_kecamatan', 'asc')
                ->get();
            
            Log::info('Kecamatan loaded for kabupaten', ['kabupaten_id' => $id_kabupaten, 'count' => $kecamatan->count()]);
            
            return response()->json($kecamatan);
        } catch (\Exception $e) {
            Log::error('Error loading kecamatan', ['kabupaten_id' => $id_kabupaten, 'error' => $e->getMessage()]);
            return response()->json(['error' => 'Gagal memuat data kecamatan'], 500);
        }
    }

    public function getDesa($id_kecamatan)
    {
        try {
            $desa = Desa::where('id_kecamatan', $id_kecamatan)
                ->select('id_desa as id', 'nama_desa as nama')
                ->orderBy('nama_desa', 'asc')
                ->get();
            
            Log::info('Desa loaded for kecamatan', ['kecamatan_id' => $id_kecamatan, 'count' => $desa->count()]);
            
            return response()->json($desa);
        } catch (\Exception $e) {
            Log::error('Error loading desa', ['kecamatan_id' => $id_kecamatan, 'error' => $e->getMessage()]);
            return response()->json(['error' => 'Gagal memuat data desa'], 500);
        }
    }
}