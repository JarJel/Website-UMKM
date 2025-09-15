<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreSellerRequest;
use App\Models\User;

class SellerController extends Controller
{
    public function create()
    {
        return view('loginRegist.regist.registSeller');
    }

    public function store(StoreSellerRequest $request)
    {
        // Upload file (jika ada) -> dapatkan path
        $ktpPath = null;
        if ($request->hasFile('ktp')) {
            $ktpName = time() . '_ktp.' . $request->ktp->extension();
            $request->ktp->move(public_path('uploads/ktp'), $ktpName);
            $ktpPath = 'uploads/ktp/' . $ktpName;
        }

        $skuPath = null;
        if ($request->hasFile('sku')) {
            $skuName = time() . '_sku.' . $request->sku->extension();
            $request->sku->move(public_path('uploads/sku'), $skuName);
            $skuPath = 'uploads/sku/' . $skuName;
        }

        // Ambil data yang sudah divalidasi
        $data = $request->validated();

        // Sesuaikan nama kolom sesuai model/database
        $data['kata_sandi'] = bcrypt($data['kata_sandi']); // hash
        $data['id_role'] = 2; // role seller (integer)
        $data['ktp'] = $ktpPath;
        $data['sku'] = $skuPath;

        // Pastikan $fillable di model memang mengandung keys di $data
        $user = User::create($data);

        if ($user) {
            return redirect()->route('home')->with('success', 'Registrasi berhasil!');
        }

        return redirect()->back()->with('error', 'Registrasi gagal, silakan coba lagi.');
    }
}
