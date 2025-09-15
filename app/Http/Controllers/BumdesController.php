<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBumdesRequest;
use App\Models\Bumdes;
use Illuminate\Support\Facades\Hash;


class BumdesController extends Controller
{
    public function showFormBumdes() {
        return view('loginRegist.regist.registAdmin');
    }

    public function registBumdes(StoreBumdesRequest $request)
    {
        $data = $request->validated();

        // Hash password sebelum simpan
        $data['kata_sandi'] = Hash::make($request->kata_sandi);

        // Upload logo jika ada
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logo_bumdes', 'public');
        }

        // Simpan ke database
        Bumdes::create($data);

        return redirect()->route('home')
            ->with('success', 'Registrasi BUMDes berhasil!');
    }
}
