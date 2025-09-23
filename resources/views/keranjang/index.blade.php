<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Saya</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
@include('homePage.navbar')
<div class="max-w-6xl mx-auto py-8">
    <h2 class="text-3xl font-bold mb-6 text-gray-800">Keranjang Saya</h2>

    @php $currentToko = null; @endphp
    <div class="space-y-6">
    @foreach($keranjang as $item)
        @if($currentToko != $item->produk->toko->id_toko)
            @php $currentToko = $item->produk->toko->id_toko; @endphp
            <div class="bg-white p-4 rounded-xl shadow toko-group" data-toko="{{ $currentToko }}">
                <h3 class="text-xl font-semibold mb-4 text-gray-900">{{ $item->produk->toko->nama_toko }}</h3>
        @endif

        <div class="border-b py-4 product-row hover:bg-gray-50 transition rounded" data-id="{{ $item->id_item_keranjang }}">
    <div class="grid grid-cols-[auto_1fr_auto] gap-4 items-center">
        <!-- Checkbox -->
        <div>
            <input type="checkbox" class="checkout-checkbox w-5 h-5 text-indigo-600 border-gray-300 rounded" data-id="{{ $item->id_item_keranjang }}">
        </div>

        <!-- Gambar & Nama Produk -->
        <div class="flex items-center gap-4">
            <img src="{{ $item->produk->gambar_produk ? asset($item->produk->gambar_produk) : 'https://placehold.co/60x60' }}" 
                 alt="{{ $item->produk->nama_produk }}" class="w-16 h-16 object-cover rounded-lg shadow-sm">
            <span class="text-gray-800 font-medium">{{ $item->produk->nama_produk }}</span>
        </div>

        <!-- Bagian aksi: jumlah, harga, hapus -->
        <div class="flex items-center gap-4 justify-end">
            <!-- Jumlah -->
            <div class="flex items-center gap-2">
                <button class="decrease px-3 py-1 bg-gray-200 rounded-lg hover:bg-gray-300 transition">-</button>
                <input type="number" class="w-16 text-center border rounded-lg py-1 quantity" value="{{ $item->jumlah_produk }}" min="1">
                <button class="increase px-3 py-1 bg-gray-200 rounded-lg hover:bg-gray-300 transition">+</button>
            </div>

            <!-- Harga -->
            <div class="text-gray-800 font-semibold">
                Rp <span class="price" data-unit="{{ $item->produk->harga_dasar }}">{{ number_format($item->produk->harga_dasar * $item->jumlah_produk, 0, ',', '.') }}</span>
            </div>

            <!-- Hapus -->
            <div>
                <button class="delete-item px-4 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Hapus</button>
            </div>
        </div>
    </div>
</div>


        @if($loop->last || ($loop->iteration < $keranjang->count() && $keranjang[$loop->iteration]->produk->toko->id_toko != $currentToko))
            </div> <!-- Tutup grup toko -->
        @endif
    @endforeach
    </div>

    <!-- Total Checkout -->
    <div class="mt-8 bg-white p-6 rounded-xl shadow flex justify-between items-center sticky bottom-0">
        <span class="text-lg font-semibold text-gray-900">Total:</span>
        <span id="checkoutTotal" class="text-2xl font-bold text-green-600">Rp 0</span>
        <button id="checkoutBtn" class="px-6 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition font-semibold">Checkout</button>
    </div>
</div>

<script>
$(document).ready(function(){

    // ===== Fungsi update jumlah item =====
    function updateItem(id, jumlah){
        $.ajax({
            url: `/keranjang/update/${id}`,
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                jumlah: jumlah
            },
            success: function(res){
                const row = $(`.product-row[data-id='${id}']`);
                const unitPrice = parseInt(row.find('.price').data('unit'));
                const totalPrice = unitPrice * jumlah;
                row.find('.price').text(new Intl.NumberFormat('id-ID').format(totalPrice));
                updateTotal();
            },
            error: function(err){
                alert('Gagal update jumlah');
            }
        });
    }

    // ===== Fungsi update total checkout =====
    function updateTotal(){
        let total = 0;
        $('.checkout-checkbox:checked').each(function(){
            const id = $(this).data('id');
            const row = $(`.product-row[data-id='${id}']`);
            const qty = parseInt(row.find('.quantity').val());
            const unit = parseInt(row.find('.price').data('unit'));
            total += qty * unit;
        });
        $('#checkoutTotal').text('Rp ' + new Intl.NumberFormat('id-ID').format(total));
    }

    // ===== Event tombol + / - =====
    $('.increase').click(function(){
        const row = $(this).closest('.product-row');
        const id = row.data('id');
        const input = row.find('.quantity');
        let val = parseInt(input.val()) + 1;
        input.val(val);
        updateItem(id, val);
    });

    $('.decrease').click(function(){
        const row = $(this).closest('.product-row');
        const id = row.data('id');
        const input = row.find('.quantity');
        let val = parseInt(input.val());
        if(val > 1) val--;
        input.val(val);
        updateItem(id, val);
    });

    // ===== Event input quantity manual =====
    $('.quantity').on('input', function(){
        const row = $(this).closest('.product-row');
        const id = row.data('id');
        let val = parseInt($(this).val());
        if(val < 1) val = 1;
        $(this).val(val);
        updateItem(id, val);
    });

    // ===== Event checkbox untuk update total =====
    $('.checkout-checkbox').change(updateTotal);

    // ===== Event hapus item =====
    $('.delete-item').click(function(){
        const row = $(this).closest('.product-row');
        const id = row.data('id');
        if(confirm('Hapus produk ini dari keranjang?')){
            $.ajax({
                url: `/keranjang/remove/${id}`,
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE'
                },
                success: function(res){
                    row.remove();
                    const tokoGroup = row.closest('.toko-group');
                    if(tokoGroup.find('.product-row').length === 0){
                        tokoGroup.remove();
                    }
                    updateTotal();
                },
                error: function(err){
                    alert('Gagal menghapus produk');
                }
            });
        }
    });

    // ===== Event checkout =====
    $('#checkoutBtn').click(function(){
        let selectedItems = [];

        $('.checkout-checkbox:checked').each(function(){
            const id = $(this).data('id');
            const row = $(`.product-row[data-id='${id}']`);
            const qty = parseInt(row.find('.quantity').val());
            selectedItems.push({
                id_item_keranjang: id,
                jumlah: qty
            });
        });

        if(selectedItems.length === 0){
            alert('Pilih produk yang ingin di-checkout!');
            return;
        }

        $.ajax({
            url: '/checkout/process',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ items: selectedItems }),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res){
                if(res.id_pending){
                    window.location.href = '/checkout/' + res.id_pending + '/payment';
                } else {
                    alert('Pesanan berhasil, tapi ID tidak ditemukan');
                }
            },
            error: function(err){
                if(err.responseJSON && err.responseJSON.message){
                    alert(err.responseJSON.message);
                } else {
                    alert('Gagal checkout produk');
                }
            }
        });
    });

});
</script>

</body>
</html>
