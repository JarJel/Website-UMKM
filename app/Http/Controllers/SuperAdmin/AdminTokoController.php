<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Toko;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTokoController extends Controller
{
    /**
     * Tampilkan semua toko
     */
    public function index()
{
    $toko = Toko::with('pengguna')->get();

    // Total
    $totalBumdes = $toko->count(); 
    $totalToko   = $toko->count(); 
    $totalUser   = User::count();

    // Growth Bumdes
    $totalBumdesBulanIni = Toko::whereMonth('created_at', now()->month)
                               ->whereYear('created_at', now()->year)
                               ->count();

    $totalBumdesBulanLalu = Toko::whereMonth('created_at', now()->subMonth()->month)
                                ->whereYear('created_at', now()->subMonth()->year)
                                ->count();

    $bumdesGrowth = $totalBumdesBulanLalu > 0
        ? round((($totalBumdesBulanIni - $totalBumdesBulanLalu) / $totalBumdesBulanLalu) * 100, 2)
        : 0;

    // Growth Toko
    $totalTokoBulanIni = Toko::whereMonth('created_at', now()->month)
                             ->whereYear('created_at', now()->year)
                             ->count();

    $totalTokoBulanLalu = Toko::whereMonth('created_at', now()->subMonth()->month)
                              ->whereYear('created_at', now()->subMonth()->year)
                              ->count();

    $tokoGrowth = $totalTokoBulanLalu > 0
        ? round((($totalTokoBulanIni - $totalTokoBulanLalu) / $totalTokoBulanLalu) * 100, 2)
        : 0;

    // Growth User
    $totalUserBulanIni = User::whereMonth('created_at', now()->month)
                             ->whereYear('created_at', now()->year)
                             ->count();

    $totalUserBulanLalu = User::whereMonth('created_at', now()->subMonth()->month)
                               ->whereYear('created_at', now()->subMonth()->year)
                               ->count();

    $userGrowth = $totalUserBulanLalu > 0
        ? round((($totalUserBulanIni - $totalUserBulanLalu) / $totalUserBulanLalu) * 100, 2)
        : 0;

    // Chart Data
    $userPerBulan = User::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('COUNT(*) as total')
        )
        ->whereYear('created_at', now()->year)
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->pluck('total', 'bulan');

    $tokoPerBulan = Toko::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('COUNT(*) as total')
        )
        ->whereYear('created_at', now()->year)
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->pluck('total', 'bulan');

    $bumdesPerBulan = Toko::select( // kalau ada model khusus Bumdes, ganti ini
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('COUNT(*) as total')
        )
        ->whereYear('created_at', now()->year)
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->pluck('total', 'bulan');

    return view('backend.superadmin.toko', compact(
        'toko',
        'totalBumdes',
        'totalToko',
        'totalUser',
        'bumdesGrowth',
        'tokoGrowth',
        'userGrowth',
        'userPerBulan',
        'tokoPerBulan',
        'bumdesPerBulan'
    ));
}



    public function show($id_toko)
    {
        $toko = Toko::with('pengguna')->findOrFail($id_toko);
        return view('backend.superadmin.toko_show', compact('toko'));
    }



    /**
     * Tampilkan form tambah toko
     */
    public function create()
    {
        return view('backend.superadmin.toko_create');
    }

    /**
     * Simpan toko baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'id_pengguna' => 'required|exists:users,id',
            'alamat' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Toko::create($request->all());

        return redirect()->route('toko.index')->with('success', 'Toko berhasil ditambahkan');
    }


    /**
     * Tampilkan form edit toko
     */
    public function edit($id_toko)
    {
        $toko = Toko::findOrFail($id_toko);
        return view('backend.superadmin.toko', compact('toko'));
    }

    /**
     * Update data toko
     */
    public function update(Request $request, $id_toko)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $toko = Toko::findOrFail($id_toko);
        $toko->update($request->all());

        return redirect()->route('backend.superadmin.toko')->with('success', 'Toko berhasil diperbarui');
    }

    /**
     * Hapus toko
     */
    public function destroy($id_toko)
    {
        $toko = Toko::findOrFail($id_toko);
        $toko->delete();

        return redirect()->route('backend.superadmin.toko')->with('success', 'Toko berhasil dihapus');
    }
}
