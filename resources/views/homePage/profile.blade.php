<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; }
        .profile-header { background-color: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .profile-avatar img { border-radius: 9999px; border: 3px solid #6366F1; }
        .profile-avatar .camera-icon { 
            position: absolute; bottom: 0; right: 0; 
            background: #6366F1; color: #fff; 
            border-radius: 9999px; padding: 0.4rem; 
            transition: all 0.2s;
        }
        .profile-avatar:hover .camera-icon { transform: scale(1.1); }
        .tab-active { border-bottom: 3px solid #6366F1; font-weight: 600; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
@include('homePage.navbar')

<!-- Header Profil -->
<header class="profile-header p-6 flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6">
    <div class="profile-avatar">
<img id="headerPhoto" 
     src="{{ Auth::user()->photo ? Storage::url(Auth::user()->photo) : 'https://placehold.co/120x120/E5E7EB/A0AEC0?text=Foto' }}" 
     alt="Foto Profil" 
     class="w-28 h-28 object-cover shadow-md rounded-full">


    </div>
    <div>
        <h1 id="headerUsername" class="text-2xl font-bold text-gray-800">{{ Auth::user()->nama_pengguna ?? 'Nama Pengguna' }}</h1>
        <p id="headerEmail" class="text-gray-500">{{ Auth::user()->email ?? 'user@example.com' }}</p>
    </div>
</header>

<!-- Tabs Profil -->
<div class="mt-6 px-6 md:px-12">
    <div class="flex space-x-6 border-b border-gray-200">
        <button class="py-3 text-gray-600 hover:text-indigo-600 tab-active" data-tab="transaksi">
            <i class="fas fa-receipt mr-2"></i> Daftar Transaksi
        </button>
        <button class="py-3 text-gray-600 hover:text-indigo-600" data-tab="alamat">
            <i class="fas fa-map-marker-alt mr-2"></i> Daftar Alamat
        </button>
        <button class="py-3 text-gray-600 hover:text-indigo-600" data-tab="menu">
            <i class="fas fa-th-large mr-2"></i> Menu Profil
        </button>
    </div>

    <div id="tab-contents" class="mt-4">
        <!-- Daftar Transaksi -->
        <div id="transaksi" class="tab-content">
            @if($pesananList->isEmpty())
                <p class="text-center text-gray-500">Belum ada transaksi.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($pesananList as $pesanan)
                    <div class="bg-white shadow-md p-4 rounded-lg hover:shadow-lg transition">
                        <p class="text-gray-700 font-semibold">Transaksi #{{ $pesanan->id_pesanan }}</p>
                        <p class="text-gray-400 text-sm">
                            Tanggal: {{ $pesanan->tanggal_pesanan ? \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->format('d M Y') : '-' }}
                        </p>
                        <p class="text-gray-400 text-sm">Status: {{ ucfirst($pesanan->status_pesanan ?? '-') }}</p>
                        <p class="text-gray-400 text-sm">Total: 
                            Rp {{ number_format(($pesanan->total_harga_produk ?? 0) + ($pesanan->biaya_pengiriman ?? 0),0,',','.') }}
                        </p>
                        <p class="text-gray-400 text-sm">Metode: {{ ucfirst($pesanan->metode_pembayaran ?? '-') }}</p>
                        @if($pesanan->alamat)
                        <p class="text-gray-400 text-sm">Alamat: {{ $pesanan->alamat->alamat_lengkap }}</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Daftar Alamat -->
        <div id="alamat" class="tab-content hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($alamatList as $alamat)
                <div class="bg-white shadow-md p-4 rounded-lg relative">
                    <p class="text-gray-700 font-semibold">{{ $alamat->nama_alamat }}</p>
                    <p class="text-gray-400 text-sm">{{ $alamat->alamat_lengkap }}</p>
                    <button type="button"
                        class="pilih-alamat absolute top-2 right-2 px-3 py-1 rounded bg-indigo-600 text-white text-sm hover:bg-indigo-700 transition
                        {{ $alamat->is_default ? 'opacity-50 cursor-not-allowed' : '' }}"
                        data-id="{{ $alamat->id_alamat }}"
                        {{ $alamat->is_default ? 'disabled' : '' }}>
                        {{ $alamat->is_default ? 'Default' : 'Pilih' }}
                    </button>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Menu Profil -->
        <div id="menu" class="tab-content hidden" x-data="profileModal()">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <button @click="editModal = true" class="bg-white shadow-md p-4 flex items-center space-x-4 hover:shadow-lg transition rounded-lg">
                    <i class="fas fa-user-cog text-indigo-600 text-2xl"></i>
                    <div>
                        <p class="text-gray-700 font-semibold">Pengaturan</p>
                        <p class="text-gray-400 text-sm">Atur profil & akun</p>
                    </div>
                </button>
            </div>

            <!-- Modal -->
            <div x-show="editModal" x-transition class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white rounded-lg w-full max-w-md p-6 relative" @click.away="editModal=false">
                    <h2 class="text-xl font-bold mb-4">Edit Profil</h2>

                    <div class="flex justify-center mb-4" x-data="{
                        preview: '{{ Auth::user()->photo ?? '' }}',
                        file: null,
                        openFile() { this.$refs.fileInput.click(); },
                        previewImage(event) {
                            const file = event.target.files[0];
                            if(file) { this.file = file; this.preview = URL.createObjectURL(file); }
                        }
                    }">
                        <div class="relative cursor-pointer" @click="openFile()">
                            <img :src="preview || 'https://placehold.co/120x120/E5E7EB/A0AEC0?text=Foto'" 
                                 class="w-28 h-28 object-cover shadow-md rounded-full" alt="Foto Profil">
                            <div class="camera-icon absolute bottom-0 right-0 bg-indigo-600 text-white rounded-full p-2">
                                <i class="fas fa-camera"></i>
                            </div>
                        </div>
                        <input type="file" x-ref="fileInput" @change="previewImage($event)" class="hidden" accept="image/*">
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Username</label>
                            <input type="text" x-model="username" class="border rounded p-2 w-full">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Email</label>
                            <input type="email" x-model="email" class="border rounded p-2 w-full">
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-6">
                        <button @click="editModal=false" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                        <button @click="submit()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                    </div>

                    <div x-show="toastShow" x-transition class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50">
                        <span x-text="toastMessage"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function profileModal() {
    return {
        editModal: false,
        toastShow: false,
        toastMessage: '',
        username: '{{ Auth::user()->nama_pengguna }}',
        email: '{{ Auth::user()->email }}',

        submit() {
            const fileInput = document.querySelector('input[type="file"]');
            let formData = new FormData();
            formData.append('nama_pengguna', this.username);
            formData.append('email', this.email);
            if(fileInput.files[0]) formData.append('photo', fileInput.files[0]);

            fetch('{{ route("profile.update") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    this.editModal = false;
                    this.toastMessage = 'Profil berhasil diperbarui!';
                    this.toastShow = true;
                    setTimeout(()=> this.toastShow=false, 3000);

                    // Update header profil
                    document.getElementById('headerUsername').textContent = data.user.nama_pengguna;
                    document.getElementById('headerEmail').textContent = data.user.email;
                    if(data.user.photo) document.getElementById('headerPhoto').src = data.user.photo;
                } else {
                    this.toastMessage = Object.values(data.errors).flat().join(' ') || 'Gagal memperbarui profil!';
                    this.toastShow = true;
                    setTimeout(()=> this.toastShow=false, 4000);
                }
            })
            .catch(()=> {
                this.toastMessage = 'Terjadi kesalahan koneksi!';
                this.toastShow = true;
                setTimeout(()=> this.toastShow=false, 3000);
            });
        }
    }
}

// Tabs
const tabs = document.querySelectorAll('[data-tab]');
const contents = document.querySelectorAll('.tab-content');
tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('tab-active'));
        tab.classList.add('tab-active');
        contents.forEach(c => c.classList.add('hidden'));
        document.getElementById(tab.dataset.tab).classList.remove('hidden');
    });
});

// Pilih alamat
document.querySelectorAll('.pilih-alamat').forEach(btn => {
    btn.addEventListener('click', function() {
        const idAlamat = this.dataset.id;
        const token = '{{ csrf_token() }}';
        const button = this;

        fetch(`/alamat/pilih/${idAlamat}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({})
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                document.querySelectorAll('.pilih-alamat').forEach(b => {
                    b.textContent = 'Pilih';
                    b.disabled = false;
                    b.classList.remove('opacity-50','cursor-not-allowed');
                });
                button.textContent = 'Default';
                button.disabled = true;
                button.classList.add('opacity-50','cursor-not-allowed');
            }
        })
        .catch(err => console.error(err));
    });
});
</script>
</body>
</html>
