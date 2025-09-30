<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\User;
use App\Models\Bumdes;
use App\Models\Toko;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Routing\Controller; // Baris ini yang ditambahkan untuk memperbaiki error

class DashboardAdminController extends Controller
{
    public function index()
    {
        // ============================
        // HITUNG TOTAL
        // ============================
        $totalBumdes = Bumdes::count();
        $totalToko   = Toko::count();
        $totalUser   = User::count();

        // ============================
        // STATISTIK KENAIKAN BULANAN
        // ============================
        $bumdesBulanIni = Bumdes::whereMonth('tanggal_dibuat', Carbon::now()->month)->count();
        $bumdesBulanLalu = Bumdes::whereMonth('tanggal_dibuat', Carbon::now()->subMonth()->month)->count();
        $bumdesGrowth = $this->hitungPersentase($bumdesBulanIni, $bumdesBulanLalu);

        $tokoBulanIni = Toko::whereMonth('tanggal_daftar', Carbon::now()->month)->count();
        $tokoBulanLalu = Toko::whereMonth('tanggal_daftar', Carbon::now()->subMonth()->month)->count();
        $tokoGrowth = $this->hitungPersentase($tokoBulanIni, $tokoBulanLalu);

        $userBulanIni = User::whereMonth('created_at', Carbon::now()->month)->count();
        $userBulanLalu = User::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $userGrowth = $this->hitungPersentase($userBulanIni, $userBulanLalu);

        // ============================
        // GRAFIK STATISTIK
        // ============================

        // PER HARI (7 HARI TERAKHIR)
        $userPerHari = User::select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $tokoPerHari = Toko::select(
                DB::raw('DATE(tanggal_daftar) as tanggal'),
                DB::raw('COUNT(*) as total')
            )
            ->where('tanggal_daftar', '>=', Carbon::now()->subDays(7))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $bumdesPerHari = Bumdes::select(
                DB::raw('DATE(tanggal_dibuat) as tanggal'),
                DB::raw('COUNT(*) as total')
            )
            ->where('tanggal_dibuat', '>=', Carbon::now()->subDays(7))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        // PER MINGGU (8 MINGGU TERAKHIR)
        $userPerMinggu = User::select(
                DB::raw('YEARWEEK(created_at, 1) as minggu'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subWeeks(8))
            ->groupBy('minggu')
            ->orderBy('minggu')
            ->get();

        $tokoPerMinggu = Toko::select(
                DB::raw('YEARWEEK(tanggal_daftar, 1) as minggu'),
                DB::raw('COUNT(*) as total')
            )
            ->where('tanggal_daftar', '>=', Carbon::now()->subWeeks(8))
            ->groupBy('minggu')
            ->orderBy('minggu')
            ->get();

        $bumdesPerMinggu = Bumdes::select(
                DB::raw('YEARWEEK(tanggal_dibuat, 1) as minggu'),
                DB::raw('COUNT(*) as total')
            )
            ->where('tanggal_dibuat', '>=', Carbon::now()->subWeeks(8))
            ->groupBy('minggu')
            ->orderBy('minggu')
            ->get();

        // PER BULAN (12 BULAN TERAKHIR)
        $userPerBulan = User::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(12))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $tokoPerBulan = Toko::select(
                DB::raw('DATE_FORMAT(tanggal_daftar, "%Y-%m") as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->where('tanggal_daftar', '>=', Carbon::now()->subMonths(12))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $bumdesPerBulan = Bumdes::select(
                DB::raw('DATE_FORMAT(tanggal_dibuat, "%Y-%m") as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->where('tanggal_dibuat', '>=', Carbon::now()->subMonths(12))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // PER TAHUN (5 TAHUN TERAKHIR)
        $userPerTahun = User::select(
                DB::raw('YEAR(created_at) as tahun'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subYears(5))
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();

        $tokoPerTahun = Toko::select(
                DB::raw('YEAR(tanggal_daftar) as tahun'),
                DB::raw('COUNT(*) as total')
            )
            ->where('tanggal_daftar', '>=', Carbon::now()->subYears(5))
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();

        $bumdesPerTahun = Bumdes::select(
                DB::raw('YEAR(tanggal_dibuat) as tahun'),
                DB::raw('COUNT(*) as total')
            )
            ->where('tanggal_dibuat', '>=', Carbon::now()->subYears(5))
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();

        return view('backend.superadmin.dashboard', compact(
            'totalBumdes',
            'totalToko',
            'totalUser',
            'bumdesGrowth',
            'tokoGrowth',
            'userGrowth',
            'userPerHari',
            'tokoPerHari',
            'bumdesPerHari',
            'userPerMinggu',
            'tokoPerMinggu',
            'bumdesPerMinggu',
            'userPerBulan',
            'tokoPerBulan',
            'bumdesPerBulan',
            'userPerTahun',
            'tokoPerTahun',
            'bumdesPerTahun'
        ));
    }

    private function hitungPersentase($sekarang, $sebelumnya)
    {
        if ($sebelumnya == 0) {
            return $sekarang > 0 ? 100 : 0;
        }
        return round((($sekarang - $sebelumnya) / $sebelumnya) * 100, 2);
    }
}
