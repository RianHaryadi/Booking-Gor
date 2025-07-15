@extends('layouts.app')

@section('title', 'Form Booking')

@section('content')
<section class="py-12 bg-gray-100">
    <div class="container max-w-xl mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6 text-center">Form Booking</h2>

        <form action="{{ route('booking.store') }}" method="POST" id="booking-form" class="bg-white p-6 rounded-lg shadow-md space-y-5">
            @csrf

            <input type="hidden" name="lapangan_mode_id" value="{{ $lapangan->id }}">

            <div>
                <label for="tanggal" class="block font-medium">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label for="jam_mulai" class="block font-medium">Jam Mulai</label>
                <input type="time" name="jam_mulai" id="jam_mulai" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label for="durasi" class="block font-medium">Durasi Bermain</label>
                <select name="durasi" id="durasi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="2">2 Jam</option>
                    <option value="4">4 Jam</option>
                    <option value="6">6 Jam</option>
                </select>
            </div>

            <div>
                <label for="jam_selesai" class="block font-medium">Jam Selesai</label>
                <input type="time" name="jam_selesai" id="jam_selesai" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100" readonly>
            </div>

            <div>
                <label for="nama_pemesan" class="block font-medium">Nama Pemesan</label>
                <input type="text" name="nama_pemesan" id="nama_pemesan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label for="nomor_telepon" class="block font-medium">Nomor Telepon</label>
                <input type="tel" name="nomor_telepon" id="nomor_telepon" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="email" class="block font-medium">Email</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="metode_pembayaran" class="block font-medium">Metode Pembayaran</label>
                <select name="metode_pembayaran" id="metode_pembayaran" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="cash">Cash</option>
                    <option value="transfer">Transfer</option>
                    <option value="qris">QRIS</option>
                </select>
            </div>

            <div>
                <label for="total_harga" class="block font-medium">Total Harga</label>
                <input type="text" id="total_harga_display" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100" readonly>
                <input type="hidden" name="total_harga" id="total_harga">
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded">
                Booking Sekarang
            </button>
        </form>
    </div>
</section>

<script>
    const jamMulaiInput = document.getElementById('jam_mulai');
    const durasiInput = document.getElementById('durasi');
    const jamSelesaiInput = document.getElementById('jam_selesai');
    const totalHargaInput = document.getElementById('total_harga');
    const totalHargaDisplay = document.getElementById('total_harga_display');
    const hargaPer2Jam = {{ $lapangan->harga }};

    function updateEndTimeAndPrice() {
        const jamMulai = jamMulaiInput.value;
        const durasi = parseInt(durasiInput.value);

        if (jamMulai && durasi) {
            const [hour, minute] = jamMulai.split(':').map(Number);
            const endHour = hour + durasi;

            if (endHour >= 24) {
                alert(`Jam selesai untuk durasi ${durasi} jam tidak boleh lewat dari jam 23:59`);
                jamSelesaiInput.value = '';
                totalHargaInput.value = '';
                totalHargaDisplay.value = '';
                return;
            }

            jamSelesaiInput.value = `${String(endHour).padStart(2, '0')}:${String(minute).padStart(2, '0')}`;
            
            const totalHarga = hargaPer2Jam * (durasi / 2);
            totalHargaInput.value = totalHarga;
            totalHargaDisplay.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalHarga);
        }
    }

    jamMulaiInput.addEventListener('change', updateEndTimeAndPrice);
    durasiInput.addEventListener('change', updateEndTimeAndPrice);

    // Validasi hari & jam operasional
    document.getElementById('booking-form').addEventListener('submit', function (e) {
        const tanggal = document.getElementById('tanggal').value;
        const jamMulai = document.getElementById('jam_mulai').value;
        const durasi = parseInt(document.getElementById('durasi').value);

        if (tanggal && jamMulai) {
            const hari = new Date(tanggal).getDay(); // 0 = Minggu, 6 = Sabtu
            if (hari === 0) {
                alert('GOR tutup hari Minggu!');
                e.preventDefault();
                return;
            }

            const [jam, menit] = jamMulai.split(':').map(Number);
            const endHour = jam + durasi;
            
            if (jam < 8 || endHour > 22) {
                alert(`Booking dengan durasi ${durasi} jam harus berada dalam jam operasional 08:00 - 22:00`);
                e.preventDefault();
                return;
            }
        }
    });
</script>
@endsection