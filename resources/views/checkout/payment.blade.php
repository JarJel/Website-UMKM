<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Pembayaran Pesanan #{{ $pesanan->id_pending ?? '-' }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://app.sandbox.midtrans.com/snap/snap.js" 
          data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body class="bg-gray-100 min-h-screen">

  {{-- Navbar --}}
  @include('homePage.navbar')

  <div class="max-w-6xl mx-auto bg-white rounded-lg shadow p-6 mt-24">
    <h1 class="text-2xl font-bold mb-6 border-b pb-3">
      Pembayaran — Pesanan #{{ $pesanan->id_pending ?? '-' }}
    </h1>

    <div class="flex flex-col md:flex-row gap-6">

      {{-- Kiri: Alamat + Produk --}}
      <div class="md:w-2/3 flex flex-col gap-6" x-data="alamatForm()" x-init="init()">

        {{-- Toast Notifikasi --}}
        <div x-show="toastShow" x-transition class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50">
          <span x-text="toastMessage"></span>
        </div>

        {{-- Bagian Alamat --}}
        <div class="bg-gray-50 p-4 rounded mb-4">
          <template x-if="alamatTersimpan">
            <div class="flex justify-between items-start">
              <div>
                <div class="flex items-center gap-2">
                  <!-- Icon Lokasi -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.656 0 3-1.344 3-3S13.656 5 12 5 9 6.344 9 8s1.344 3 3 3z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4.5 8-10a8 8 0 10-16 0c0 5.5 8 10 8 10z" />
                  </svg>

                  <div>
                    <p class="text-gray-700 font-medium inline">Alamat:</p>
                    <span class="font-semibold" x-text="nama"></span>
                  </div>
                </div>
                <p class="font-semibold text-gray-700">
                  <span x-text="alamat"></span> |
                  Kode Pos: <span x-text="kodepos"></span> |
                  HP: <span x-text="telepon"></span>
                </p>
              </div>
              <div class="ml-4 flex-shrink-0">
                <button @click="open = true" 
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                  Tambah / Ubah Alamat
                </button>
              </div>
            </div>
          </template>

          <template x-if="!alamatTersimpan">
            <div class="flex justify-between items-center">
              <p class="text-gray-700 font-medium">Belum memiliki alamat?</p>
              <button @click="open = true" 
                      class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Tambah Alamat
              </button>
            </div>
          </template>
        </div>

        {{-- Modal Tambah / Pilih Alamat --}}
        <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
          <div class="bg-white rounded-lg w-full max-w-md p-6 relative" @click.away="open = false">
            <h2 class="text-xl font-bold mb-4">Alamat</h2>

            <!-- Tabs -->
            <div class="flex gap-2 mb-4">
              <button 
                :class="{'bg-blue-600 text-white': tab==='tambah', 'bg-gray-200 text-gray-700': tab!=='tambah'}"
                class="px-3 py-1 rounded" 
                @click="tab='tambah'">Tambah Alamat</button>

              <button 
                :class="{'bg-blue-600 text-white': tab==='pilih', 'bg-gray-200 text-gray-700': tab!=='pilih'}"
                class="px-3 py-1 rounded" 
                @click="tab='pilih'">Pilih Alamat</button>
            </div>

            <!-- Tab Tambah Alamat -->
            <div x-show="tab==='tambah'" class="space-y-4">
              <label class="text-gray-600 font-medium">Nama Penerima</label>
              <input type="text" x-model="nama" placeholder="Tulis nama penerima" 
                     class="border rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">

              <label class="text-gray-600 font-medium">Alamat Lengkap</label>
              <textarea x-model="alamat" placeholder="Tulis alamat lengkap" 
                        class="border rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4"></textarea>

              <label class="text-gray-600 font-medium">Kode Pos</label>
              <input type="text" x-model="kodepos" placeholder="Kode Pos" 
                     class="border rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">

              <label class="text-gray-600 font-medium">Nomor HP</label>
              <input type="text" x-model="telepon" placeholder="Tulis nomor HP" 
                     class="border rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">

              <div class="flex justify-end gap-2 mt-4">
                <button @click="open=false" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                <button @click="simpanAlamat()" 
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Simpan Alamat</button>
              </div>
            </div>

            <!-- Tab Pilih Alamat -->
            <div x-show="tab==='pilih'" x-cloak class="space-y-2 max-h-64 overflow-y-auto">
              <template x-for="alamatItem in alamatDb" :key="alamatItem.id_alamat">
                <div class="border p-2 rounded flex justify-between items-center">
                  <div>
                    <p class="font-semibold" x-text="alamatItem.nama_penerima"></p>
                    <p x-text="alamatItem.alamat_lengkap + ' | Kode Pos: ' + alamatItem.kode_pos + ' | HP: ' + alamatItem.telepon_penerima"></p>
                  </div>
                  <button @click="pilihAlamatDb(alamatItem)" 
                          class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Pilih</button>
                </div>
              </template>

              <template x-if="alamatDb.length === 0">
                <p class="text-gray-500 text-center">Belum ada alamat tersimpan.</p>
              </template>
            </div>

          </div>
        </div>

        {{-- List Produk --}}
        <div class="space-y-6">
          @php
              $groupedCart = $cartItems->groupBy(fn($item) => $item->produk->toko->id ?? 0);
          @endphp

          @foreach($groupedCart as $tokoId => $items)
              <div class="flex items-center gap-2 mb-2">
                <h2 class="text-lg font-semibold">
                  {{ $items[0]->produk->toko->nama_toko ?? 'Toko Tidak Diketahui' }}
                </h2>
              </div>

              <div class="space-y-3">
                @foreach($items as $item)
                    <div class="flex border-b pb-2 gap-3 items-center">
                      <div class="w-20 h-20 flex-shrink-0">
                        <img src="{{ $item->produk->gambar_produk ?? 'https://via.placeholder.com/80' }}" 
                             alt="{{ $item->nama_produk_snapshot ?? ($item->produk->nama_produk ?? '-') }}" 
                             class="w-full h-full object-cover rounded">
                      </div>
                      <div class="flex-1 flex flex-col">
                        <div class="font-medium">{{ $item->nama_produk_snapshot ?? ($item->produk->nama_produk ?? '-') }}</div>
                        <div class="text-sm text-gray-500">Jumlah: {{ $item->jumlah ?? 0 }}</div>
                      </div>
                      <div class="text-right font-semibold text-blue-600 flex-shrink-0">
                        Rp {{ number_format((($item->harga_saat_pilih ?? ($item->produk->harga_dasar ?? 0)) * ($item->jumlah ?? 0)),0,',','.') }}
                      </div>
                    </div>
                @endforeach
              </div>
          @endforeach
        </div>

      </div>

      {{-- Kanan: Ringkasan --}}
      <div class="md:w-1/3 bg-gray-50 rounded p-4 flex flex-col gap-4 h-fit shadow-sm">
        <div class="flex justify-between">
          <span>Subtotal</span>
          <span>Rp {{ number_format($totalProduk ?? 0,0,',','.') }}</span>
        </div>
        <div class="flex justify-between">
          <span>Pengiriman</span>
          <span>Rp {{ number_format($biayaPengiriman ?? 0,0,',','.') }}</span>
        </div>
        <div class="flex justify-between font-bold mt-3 text-lg">
          <span>Total</span>
          <span class="text-green-600">Rp {{ number_format($total ?? 0,0,',','.') }}</span>
        </div>
        <button id="pay-button" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 mt-4">
          Bayar Sekarang
        </button>
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <script>
function alamatForm() {
  return {
    nama: '',
    alamat: '',
    kodepos: '',
    telepon: '',
    open: false,
    tab: 'tambah',
    alamatTersimpan: false,
    alamatDb: [],
    toastShow: false,
    toastMessage: '',

    init() {
      this.loadAlamatDb();
    },

    showToast(message) {
      this.toastMessage = message;
      this.toastShow = true;
      setTimeout(() => this.toastShow = false, 3000);
    },

    loadAlamatDb() {
        fetch('{{ route("alamat.list") }}')
        .then(res => res.json())
        .then(data => {
            console.log('Data dari server:', data); 
            this.alamatDb = data.alamat || [];

            // cari yang is_default = 1
            const defaultAlamat = this.alamatDb.find(a => a.is_default == 1);

            if(defaultAlamat){
                this.nama = defaultAlamat.nama_penerima;
                this.alamat = defaultAlamat.alamat_lengkap;
                this.kodepos = defaultAlamat.kode_pos;
                this.telepon = defaultAlamat.telepon_penerima;
                this.alamatTersimpan = true;
            }
        });
    },


    simpanAlamat() {
      fetch('{{ route("alamat.store") }}', {
        method: 'POST',
        headers: {
          'Content-Type':'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
          nama_penerima: this.nama,
          telepon_penerima: this.telepon,
          alamat_lengkap: this.alamat,
          kode_pos: this.kodepos,
          is_default: 1
        })
      })
      .then(res => res.json())
      .then(data => {
        if(data.success){
          this.open = false;
          this.alamatTersimpan = true;
          this.loadAlamatDb();
          this.showToast('Alamat berhasil disimpan!');
        } else {
          this.showToast('Gagal menyimpan alamat');
        }
      });
    },

    pilihAlamatDb(item) {
    fetch(`/alamat/pilih/${item.id_alamat}`, { method: 'POST', headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'}})
        .then(res => res.json())
        .then(data => {
        if(data.success){
            this.nama = item.nama_penerima;
            this.alamat = item.alamat_lengkap;
            this.kodepos = item.kode_pos;
            this.telepon = item.telepon_penerima;
            this.alamatTersimpan = true;
            this.open = false;
            this.showToast('Alamat dipilih!');
        }
        });
    }
  }
}

// Midtrans Snap
document.addEventListener('alpine:init', () => {
  document.getElementById('pay-button').onclick = function(){
    snap.pay('{{ $snapToken ?? '' }}', {
      onSuccess: function(result){
        window.location.href = "/checkout/{{ $pesanan->id_pending ?? 0 }}/success";
      },
      onPending: function(result){
        document.querySelector('[x-data]').__x.$data.showToast('Menunggu pembayaran');
      },
      onError: function(result){
        document.querySelector('[x-data]').__x.$data.showToast('Pembayaran gagal');
      }
    });
  };
});
</script>

</body>
</html>
