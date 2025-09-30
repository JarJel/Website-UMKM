<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use App\Models\Pesanan;
use App\Models\Alamat;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil beserta transaksi dan alamat.
     */
    public function index(): View
    {
        $userId = auth()->id();

        $pesananList = Pesanan::with('alamat', 'items.produk')
                        ->where('id_pengguna', $userId)
                        ->orderBy('tanggal_pesanan', 'desc')
                        ->get();

        $alamatList = Alamat::where('id_pengguna', $userId)->get();

        return view('homePage.profile', [
            'user' => auth()->user(),
            'pesananList' => $pesananList,
            'alamatList' => $alamatList,
        ]);
    }

    /**
     * Update profil username, email, dan foto via AJAX.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_pengguna' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email,'.$user->id_pengguna.',id_pengguna',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        // Update data user
        $user->nama_pengguna = $request->nama_pengguna;
        $user->email = $request->email;

        // Upload foto jika ada
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            $path = $request->file('photo')->store('profile', 'public');
            $user->photo = $path;
        }

        // Reset email_verified_at jika email berubah
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui',
            'user' => [
                'nama_pengguna' => $user->nama_pengguna,
                'email' => $user->email,
                'photo' => $user->photo ? Storage::url($user->photo) : null,
            ]
        ]);
    }

    /**
     * Hapus akun user.
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Tampilkan daftar transaksi user.
     */
    public function transaksi()
    {
        $userId = Auth::id();

        $pesananList = Pesanan::with('items.produk')
                        ->where('id_pengguna', $userId)
                        ->orderBy('tanggal_pesanan', 'desc')
                        ->get();

        return view('profile.transaksi', compact('pesananList'));
    }
}
