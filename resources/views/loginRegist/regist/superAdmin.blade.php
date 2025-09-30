@extends('superadmin.adminSuper')

@section('title', 'Register Super Admin')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Registrasi Super Admin</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 p-2 mb-4 rounded">{{ session('success') }}</div>
    @endif

    {{-- Error Handling --}}
    @if($errors->any())
        <div class="bg-red-100 p-2 mb-4 rounded">
            <ul class="list-disc list-inside text-red-600">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('superadmin.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Nama</label>
            <input type="text" name="nama_pengguna" class="w-full border p-2 rounded" value="{{ old('nama_pengguna') }}">
            @error('nama_pengguna') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded" value="{{ old('email') }}">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">Password</label>
            <input type="password" name="kata_sandi" class="w-full border p-2 rounded">
            @error('kata_sandi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">Konfirmasi Password</label>
            <input type="password" name="kata_sandi_confirmation" class="w-full border p-2 rounded">
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Register
        </button>
    </form>
</div>
@endsection
