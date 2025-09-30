<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alamat;
use Illuminate\Support\Facades\Auth;

class AlamatController extends Controller
{
    // Menyimpan alamat baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'telepon_penerima' => 'required|string|max:20',
            'alamat_lengkap' => 'required|string',
            'kode_pos' => 'nullable|string|max:10',
            'id_desa' => 'nullable|integer',
        ]);

        // Jika belum ada alamat, otomatis default
        $is_default = !Alamat::where('id_pengguna', Auth::id())->exists();

        $alamat = Alamat::create([
            'id_pengguna' => Auth::id(),
            'nama_penerima' => $request->nama_penerima,
            'telepon_penerima' => $request->telepon_penerima,
            'alamat_lengkap' => $request->alamat_lengkap,
            'kode_pos' => $request->kode_pos,
            'id_desa' => $request->id_desa,
            'is_default' => $is_default,
        ]);

        return response()->json([
            'success' => true,
            'alamat' => $alamat
        ]);
    }

    // app/Http/Controllers/AlamatController.php
    public function pilihAlamat($id_alamat)
    {
        $userId = auth()->id();

        // Set semua alamat user menjadi is_default = 0
        Alamat::where('id_pengguna', $userId)->update(['is_default' => 0]);

        // Set alamat yang dipilih menjadi is_default = 1
        $alamat = Alamat::where('id_alamat', $id_alamat)
                        ->where('id_pengguna', $userId)
                        ->firstOrFail();
        $alamat->is_default = 1;
        $alamat->save();

        // Kembalikan response JSON
        return response()->json([
            'success' => true,
            'id_alamat' => $alamat->id_alamat,
        ]);
    }



    // Menampilkan semua alamat user yang login
    public function list() {
        $alamat = Alamat::where('id_pengguna', Auth::id())
                        ->orderBy('created_at', 'desc') // <-- urut terbaru dulu
                        ->get();

        return response()->json(['alamat' => $alamat]);
    }

}
