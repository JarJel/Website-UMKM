@extends('superadmin.adminSuper')

@section('title', 'Edit Bumdes')

@section('content')
    <h2>Edit Bumdes</h2>
    <form action="{{ route('superadmin.update-bumdes', $bumdes->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="nama" value="{{ $bumdes->nama }}" placeholder="Nama Bumdes">
        <button type="submit">Update</button>
    </form>
@endsection
