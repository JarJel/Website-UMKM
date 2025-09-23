<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pembayaran Pesanan #{{ $pesanan->id_pending ?? '-' }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 min-h-screen">

@include('homePage.navbar')

<div class="max-w-6xl mx-auto bg-white rounded-lg shadow p-6 mt-24" x-data="alamatForm()" x-init="init()" x-ref="alamatRoot">

    <h1 class="text-2xl font-bold mb-6 border-b pb-3">
        Pembayaran — Pesanan #{{ $pesanan->id_pending ?? '-' }}
    </h1>

    <div class="flex flex-col md:flex-row gap-6">

        {{-- Alamat & Produk --}}
        <div class="md:w-2/3 flex flex-col gap-6">

            {{-- Toast Notifikasi --}}
            <div x-show="toastShow" x-transition class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50">
                <span x-text="toastMessage"></span>
            </div>

            {{-- Alamat --}}
            <div class="bg-gray-50 p-4 rounded mb-4">
                <template x-if="alamatTersimpan">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-700 font-medium">Alamat:</p>
                            <p class="font-semibold" x-text="alamat"></p>
                            <p>Kode Pos: <span x-text="kodepos"></span> | HP: <span x-text="telepon"></span></p>
                        </div>
                        <div>
                            <button @click="open = true" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Ubah / Tambah Alamat
                            </button>
                        </div>
                    </div>
                </template>
                <template x-if="!alamatTersimpan">
                    <div class="flex justify-between items-center">
                        <p class="text-gray-700 font-medium">Belum ada alamat</p>
                        <button @click="open = true" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Alamat</button>
                    </div>
                </template>
            </div>

            {{-- Modal Alamat --}}
            <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 overflow-auto">
                <div class="bg-white rounded-lg w-full max-w-md p-6 relative" @click.away="open=false">
                    <h2 class="text-xl font-bold mb-4">Alamat</h2>

                    {{-- Tabs --}}
                    <div class="flex gap-2 mb-4">
                        <button @click="tab='tambah'" :class="tab==='tambah'? 'bg-blue-600 text-white':'bg-gray-200 text-gray-700'" class="px-3 py-1 rounded">Tambah Alamat</button>
                        <button @click="tab='pilih'" :class="tab==='pilih'? 'bg-blue-600 text-white':'bg-gray-200 text-gray-700'" class="px-3 py-1 rounded">Pilih Alamat</button>
                    </div>

                    {{-- Tab Tambah --}}
                    <div x-show="tab==='tambah'" class="space-y-4">
                        <label>Nama Penerima</label>
                        <input type="text" x-model="nama" placeholder="Nama penerima" class="border rounded p-2 w-full">

                        <label>Alamat Lengkap</label>
                        <textarea x-model="alamat" placeholder="Alamat lengkap" class="border rounded p-2 w-full" rows="3"></textarea>

                        <label>Kode Pos</label>
                        <input type="text" x-model="kodepos" placeholder="Kode Pos" class="border rounded p-2 w-full">

                        <label>Nomor HP</label>
                        <input type="text" x-model="telepon" placeholder="Nomor HP" class="border rounded p-2 w-full">

                        <div class="flex justify-end gap-2 mt-4">
                            <button @click="open=false" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                            <button @click="simpanAlamat()" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Simpan</button>
                        </div>
                    </div>

                    {{-- Tab Pilih --}}
                    <div x-show="tab==='pilih'" class="space-y-2 max-h-64 overflow-y-auto">
                        <template x-for="item in alamatDb" :key="item.id_alamat">
                            <div class="border p-2 rounded flex justify-between items-center">
                                <div>
                                    <p class="font-semibold" x-text="item.nama_penerima"></p>
                                    <p x-text="item.alamat_lengkap + ' | Kode Pos: ' + item.kode_pos + ' | HP: ' + item.telepon_penerima"></p>
                                </div>
                                <button @click="pilihAlamatDb(item)" class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Pilih</button>
                            </div>
                        </template>
                        <template x-if="alamatDb.length===0">
                            <p class="text-gray-500 text-center">Belum ada alamat tersimpan</p>
                        </template>
                    </div>
                </div>
            </div>

            {{-- List Produk --}}
            <div class="space-y-4">
                @foreach($cartItems as $item)
                    <div class="flex items-center border-b pb-2 gap-3 flex-wrap">
                        <img src="{{ $item->produk->gambar_produk ?? 'https://via.placeholder.com/80' }}" class="w-20 h-20 object-cover rounded">
                        <div class="flex-1 flex flex-col">
                            <div class="font-medium truncate">{{ $item->produk->nama_produk }}</div>
                            <div class="text-gray-500">Jumlah: {{ $item->jumlah }}</div>
                        </div>
                        <div class="text-right font-semibold text-blue-600">Rp {{ number_format($item->produk->harga_dasar*$item->jumlah,0,',','.') }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Ringkasan --}}
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

            {{-- Tombol Bayar --}}
            <button @click="payNow()" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 mt-4">
                Bayar Sekarang
            </button>
        </div>

    </div>
</div>

<script>
function alamatForm(){
    return {
        nama:'', alamat:'', kodepos:'', telepon:'',
        open:false, tab:'tambah', alamatTersimpan:false, alamatDb:[],
        toastShow:false, toastMessage:'',

        init(){
            this.loadAlamatDb();
        },

        showToast(msg){
            this.toastMessage = msg;
            this.toastShow = true;
            setTimeout(()=>this.toastShow=false,3000);
        },

        loadAlamatDb(){
            fetch('{{ route("alamat.list") }}')
            .then(res=>res.json())
            .then(data=>{
                this.alamatDb = data.alamat || [];
                const defaultAlamat = this.alamatDb.find(a=>a.is_default==1);
                if(defaultAlamat){
                    this.nama = defaultAlamat.nama_penerima;
                    this.alamat = defaultAlamat.alamat_lengkap;
                    this.kodepos = defaultAlamat.kode_pos;
                    this.telepon = defaultAlamat.telepon_penerima;
                    this.alamatTersimpan = true;
                }
            });
        },

        simpanAlamat(){
            fetch('{{ route("alamat.store") }}',{
                method:'POST',
                headers:{
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN':'{{ csrf_token() }}'
                },
                body:JSON.stringify({
                    nama_penerima:this.nama,
                    telepon_penerima:this.telepon,
                    alamat_lengkap:this.alamat,
                    kode_pos:this.kodepos,
                    is_default:1
                })
            })
            .then(res=>res.json())
            .then(data=>{
                if(data.success){
                    this.open=false;
                    this.alamatTersimpan=true;
                    this.loadAlamatDb();
                    this.showToast('Alamat tersimpan!');
                } else {
                    this.showToast('Gagal menyimpan alamat');
                }
            })
            .catch(()=>this.showToast('Terjadi kesalahan koneksi'));
        },

        pilihAlamatDb(item){
            fetch(`/alamat/pilih/${item.id_alamat}`, {
                method:'POST',
                headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}
            })
            .then(res=>res.json())
            .then(data=>{
                if(data.success){
                    this.nama = item.nama_penerima;
                    this.alamat = item.alamat_lengkap;
                    this.kodepos = item.kode_pos;
                    this.telepon = item.telepon_penerima;
                    this.alamatTersimpan = true;
                    this.open=false;
                    this.showToast('Alamat dipilih!');
                }
            });
        },

        payNow() {
          if (!this.alamatTersimpan) {
              this.showToast('Pilih alamat terlebih dahulu!');
              return;
          }

          let alamat = this.alamatDb.find(a => a.is_default == 1);

          fetch(`/checkout/{{ $pesanan->id_pending }}/pay`, {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
              body: JSON.stringify({ id_alamat: alamat.id_alamat })
          })
          .then(res => res.json())
          .then(data => {
              if (data.success) {
                  window.location.href = `/pesanan/${data.id_pesanan}/tracking`;
              } else {
                  this.showToast('Pembayaran gagal: ' + data.message);
              }
          })
          .catch(err => this.showToast('Terjadi kesalahan koneksi'));
      }
    }
}
</script>

</body>
</html>
