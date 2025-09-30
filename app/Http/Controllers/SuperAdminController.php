<?php

namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Bumdes;
    use App\Models\Toko;
    use App\Models\User;
    use App\Models\Transaksi;
    use App\Models\Desa;
    use App\Models\Provinsi;
    use App\Models\Kabupaten;
    use App\Models\Kecamatan;
    use App\Models\Kategori;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\DB;

    class SuperAdminController extends Controller
    {
        /**
         * Dashboard Super Admin
         */
        public function dashboard()
        {
            $totalBumdes = Bumdes::count();
            $totalToko   = Toko::count();
            $totalUser   = User::count();

            // Data untuk chart (misal bulanan, bisa disesuaikan)
            $userPerMonth = User::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                                ->groupBy('month')
                                ->pluck('total', 'month')
                                ->toArray();

            $tokoPerMonth = Toko::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                                ->groupBy('month')
                                ->pluck('total', 'month')
                                ->toArray();

            $bumdesPerMonth = Bumdes::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                                ->groupBy('month')
                                ->pluck('total', 'month')
                                ->toArray();

            return view('superadmin.dashboard', compact(
                'totalBumdes', 
                'totalToko', 
                'totalUser',
                'userPerMonth',
                'tokoPerMonth',
                'bumdesPerMonth'
            ));
        }
        /**
         * Kelola BUMDES
         */
        public function kelolaBumdes()
        {
            // Ambil semua BUMDES beserta relasi user dan wilayah
            $provinsis = Provinsi::all();
            $kategori = Kategori::all();
            $bumdes = Bumdes::all(); 
            
            return view('superadmin.kelola-bumdes', compact('bumdes', 'provinsis', 'kategori'));
        }
        
        
        public function daftarBumdes()
        {
            // Ambil semua data BUMDES
            $bumdes = Bumdes::with(['desa.kecamatan.kabupaten.provinsi'])->get();

            // Kirim ke view
            return view('superadmin.daftarBumdes', compact('bumdes'));
        }

        public function editBumdes($id)
        {
            $bumdes = Bumdes::findOrFail($id);
            $provinsis = Provinsi::all();
            $kategori = Kategori::all();
            return view('superadmin.editBumdes', compact('bumdes', 'provinsis', 'kategori'));
        }

        public function updateBumdes(Request $request, $id)
        {
            $bumdes = Bumdes::findOrFail($id);

            $request->validate([
                'nama_bumdes' => 'required|string|max:255|unique:bumdes,nama_bumdes,'.$id.',id_bumdes',
                'id_desa' => 'required|exists:desa,id',
                'deskripsi' => 'nullable|string',
                'alamat_bumdes' => 'nullable|string',
                'nomor_telepon' => 'nullable|string',
                'email' => 'nullable|email',
                'logo' => 'nullable|string',
                'nomor_rekening' => 'nullable|string',
            ]);

            $bumdes->update([
                'nama_bumdes'    => $request->nama_bumdes,
                'id_desa'        => $request->id_desa,
                'deskripsi'      => $request->deskripsi,
                'alamat_bumdes'  => $request->alamat_bumdes,
                'nomor_telepon'  => $request->nomor_telepon,
                'email'          => $request->email,
                'logo'           => $request->logo,
                'nomor_rekening' => $request->nomor_rekening,
            ]);

            return redirect()->route('superadmin.daftar-bumdes')->with('success', 'BUMDES berhasil diperbarui!');
        }

        public function deleteBumdes($id)
        {
            $bumdes = Bumdes::findOrFail($id);
            $bumdes->delete();
            return redirect()->route('superadmin.daftar-bumdes')->with('success', 'BUMDES berhasil dihapus!');
        }


        /**
         * Simpan Bumdes baru
         */
        

   public function storeBumdes(Request $request)
{
    $request->validate([
        'nama_pengguna'  => 'required|string|max:255',
        'nama_bumdes'    => 'required|string|max:255|unique:bumdes,nama_bumdes',
        'id_desa'        => 'required|exists:desa,id',
        'deskripsi'      => 'nullable|string',
        'alamat_bumdes'  => 'nullable|string',
        'nomor_telepon'  => 'nullable|string',
        'email'          => 'required|email|unique:pengguna,email|unique:bumdes,email',
        'logo'           => 'nullable|string',
        'nomor_rekening' => 'nullable|string',
        'kata_sandi'     => 'required|min:6|confirmed',
    ]);

    DB::transaction(function() use ($request) {
        // Simpan di tabel bumdes
        $bumdes = Bumdes::create([
            'nama_bumdes'    => $request->nama_bumdes,
            'id_desa'        => $request->id_desa,
            'deskripsi'      => $request->deskripsi ?? null,
            'alamat_bumdes'  => $request->alamat_bumdes ?? null,
            'nomor_telepon'  => $request->nomor_telepon ?? null,
            'email'          => $request->email,
            'kata_sandi'     => Hash::make($request->kata_sandi), // optional jika kolom ada di bumdes
            'logo'           => $request->logo ?? null,
            'nomor_rekening' => $request->nomor_rekening ?? null,
            'id_role'        => 3,
            'tanggal_dibuat' => now(),
        ]);

        // Simpan di tabel pengguna untuk login
        User::create([
            'nama_pengguna' => $request->nama_pengguna,
            'email'         => $request->email,
            'kata_sandi'    => Hash::make($request->kata_sandi),
            'id_role'       => 3, // BUMDES
        ]);
    });

    return redirect()->route('superadmin.kelola-bumdes')
                     ->with('success', 'BUMDES berhasil ditambahkan!');
}



        /**
         * API Wilayah (Provinsi → Kabupaten → Kecamatan → Desa)
         */
        public function getKabupaten($provinsiId)
        {
            return response()->json(
                Kabupaten::where('provinsi_id', $provinsiId)
                    ->get(['id', 'name'])
            );
        }

        public function getKecamatan($kabupatenId)
        {
            return response()->json(
                Kecamatan::where('kabupaten_id', $kabupatenId)
                    ->get(['id', 'name'])
            );
        }

        public function getDesa($kecamatanId)
        {
            return response()->json(
                Desa::where('kecamatan_id', $kecamatanId)
                    ->get(['id', 'name'])
            );
        }

        // Menampilkan daftar toko (sudah ada)
        public function manajemenToko()
        {
            $toko = Toko::with('user')->get();
            return view('superadmin.toko', compact('toko'));
        }

        // Form edit toko
        public function editToko($id)
        {
            $toko = Toko::findOrFail($id);
            return view('superadmin.toko.edit', compact('toko'));
        }

        // Update toko
        public function updateToko(Request $request, $id)
        {
            $toko = Toko::findOrFail($id);

            $request->validate([
                'nama_toko'   => 'required|string|max:255',
                'alamat'      => 'nullable|string|max:255',
                'nomor_telepon' => 'nullable|string|max:20',
            ]);

            $toko->update([
                'nama_toko'     => $request->nama_toko,
                'alamat'        => $request->alamat,
                'nomor_telepon' => $request->nomor_telepon,
            ]);

            return redirect()->route('superadmin.toko')->with('success', 'Toko berhasil diperbarui');
        }

        // ✅ Menyimpan kategori baru
        public function storeKategori(Request $request)
        {
            $request->validate([
                'nama_kategori' => 'required|string|max:100',
                'icon_kategori'   => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            ]);

            $iconPath = null;
            if ($request->hasFile('icon_kategori')) {
                $iconPath = $request->file('icon_kategori')->store('kategori-icons', 'public');
            }

            Kategori::create([
                'nama_kategori' => $request->nama_kategori,
                'slug_kategori' => Str::slug($request->nama_kategori),
                'icon' => $iconPath,
            ]);

            // Redirect kembali ke halaman kelola BUMDES agar tab kategori juga terlihat
            return redirect()->route('superadmin.kelola-bumdes')
                            ->with('success', 'Kategori berhasil ditambahkan.');
        }



        // Hapus toko
        public function destroyToko($id)
        {
            $toko = Toko::findOrFail($id);

            try {
                $toko->delete();
                return redirect()->route('superadmin.toko')->with('success', 'Toko berhasil dihapus');
            } catch (\Exception $e) {
                return redirect()->route('superadmin.toko')->with('error', 'Gagal menghapus toko: ' . $e->getMessage());
            }
        }

        /**
         * Manajemen Transaksi
         */
        public function manajemenTransaksi()
        {
            $transaksi = Transaksi::latest()->get();
            return view('superadmin.transaksi.index', compact('transaksi'));
        }

        /**
         * Manajemen User
         */
        public function manajemenUser()
        {
            $users = User::all();
            return view('superadmin.user.index', compact('users'));
        }
    }
