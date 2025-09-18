@extends('layouts.app')
@section('content')
<h2>Daftar Toko Pending</h2>
<table border="1">
    <tr>
        <th>Nama Toko</th>
        <th>Owner</th>
        <th>Aksi</th>
    </tr>
    @foreach($tokoPending as $toko)
    <tr>
        <td>{{ $toko->nama_toko }}</td>
        <td>{{ $toko->user->nama_lengkap }}</td>
        <td><a href="{{ route('bumdes.verifikasi.edit', $toko->id_toko) }}">Verifikasi</a></td>
    </tr>
    @endforeach
</table>
@endsection
