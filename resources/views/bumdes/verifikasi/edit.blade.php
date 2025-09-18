@extends('layouts.app')
@section('content')
<h2>Verifikasi Toko: {{ $toko->nama_toko }}</h2>

<form action="{{ route('bumdes.verifikasi.update', $toko->id_toko) }}" method="POST">
    @csrf
    <label>Status Verifikasi:</label>
    <select name="status_verifikasi">
        <option value="approved">Approve</option>
        <option value="rejected">Reject</option>
    </select><br><br>

    <label>Dokumen SKU:</label>
    <input type="text" name="dokumen_sku" value="{{ $toko->verifikasi?->dokumen_sku }}"><br>

    <label>Dokumen KTP:</label>
    <input type="text" name="dokumen_ktp" value="{{ $toko->verifikasi?->dokumen_ktp }}"><br>

    <label>Nomor Rekening:</label>
    <input type="text" name="nomor_rekening" value="{{ $toko->verifikasi?->nomor_rekening }}"><br>

    <label>Catatan Admin:</label>
    <textarea name="catatan_admin">{{ $toko->verifikasi?->catatan_admin }}</textarea><br>

    <button type="submit">Simpan</button>
</form>
@endsection
