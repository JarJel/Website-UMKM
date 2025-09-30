<?php

namespace App\Http\Controllers;

use App\Models\Bumdes;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BumdesController extends Controller
{
    public function kelolaBumdes()
    {
        $provinsis = Provinsi::all();
        $bumdes = Bumdes::with('desa.kecamatan.kabupaten.provinsi')->get();

        return view('superadmin.kelola-bumdes', compact('provinsis', 'bumdes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:150',
            'nama_pengguna' => 'required|string|max:100|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'nama_bumdes' => 'required|string|max:150',
            'id_desa' => 'required|exists:desa,id',
        ]);

        DB::beginTransaction();
        try {
            // Buat akun user untuk pengelola bumdes
            $user = User::create([
                'nama_lengkap' => $request->nama_lengkap,
                'username' => $request->nama_pengguna,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nomor_telepon' => $request->nomor_telepon,
            ]);

            // Assign role bumdes (misal id_role = 3)
            $user->roles()->create([
                'id_role' => 3
            ]);

            // Buat data bumdes
            Bumdes::create([
                'id_pengguna' => $user->id_pengguna,
                'nama_bumdes' => $request->nama_bumdes,
                'id_desa' => $request->id_desa,
            ]);

            DB::commit();

            return redirect()->route('superadmin.kelola-bumdes')
                ->with('success', 'BUMDES berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menyimpan BUMDES: '.$e->getMessage());
        }
    }

    // endpoint ajax (dipakai JS)
    public function getKabupaten($provinsiId)
    {
        return response()->json(Kabupaten::where('id_provinsi', $provinsiId)->get(['id','name']));
    }
    public function getKecamatan($kabupatenId)
    {
        return response()->json(Kecamatan::where('id_kabupaten', $kabupatenId)->get(['id','name']));
    }
    public function getDesa($kecamatanId)
    {
        return response()->json(Desa::where('id_kecamatan', $kecamatanId)->get(['id','name']));
    }
}
