<div class="p-6">

    @if (session('success'))
    <div class="p-3 mb-4 bg-green-500 text-white rounded">
        {{ session('success') }}
    </div>
    @endif

    <h2 class="text-xl font-bold mb-4">Pilih Kamar</h2>

    <!-- GRID CARD -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach($kamars as $kamar)

        {{-- Ambil reservasi terakhir kamar --}}
        @php
        $latest = \App\Models\Reservasi::where('kamar_id', $kamar->id)
        ->orderBy('id', 'desc')
        ->first();

        if (!$latest) {
        $status = 'available';
        } else {
        switch ($latest->status) {
        case 'menunggu': $status = 'pending'; break;
        case 'disetujui': $status = 'reserved'; break;
        case 'ditolak': $status = 'available'; break;
        case 'selesai': $status = 'available'; break;
        }
        }
        @endphp

        <div class="bg-white rounded-lg shadow border hover:shadow-lg transition p-4">

            <img src="{{ $kamar->foto ? asset('storage/' . $kamar->foto) : 'https://via.placeholder.com/400' }}"
                class="w-full h-40 object-cover rounded mb-3">

            <h3 class="text-lg font-semibold">{{ $kamar->nama_kamar }}</h3>
            <p class="text-gray-600">{{ $kamar->tipe }}</p>

            <p class="text-blue-600 font-bold mt-2">
                Rp {{ number_format($kamar->harga, 0, ',', '.') }} / malam
            </p>

            <p class="text-sm mt-1 text-gray-500">Jumlah bed: {{ $kamar->jumlah_bed }}</p>

            {{-- BADGE STATUS --}}
            @if($status == 'pending')
            <span class="inline-block mt-3 px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                Pending
            </span>
            @elseif($status == 'reserved')
            <span class="inline-block mt-3 px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                Reserved
            </span>
            @else
            <span class="inline-block mt-3 px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                Tersedia
            </span>
            @endif

            {{-- BUTTON PESAN --}}
            <div class="mt-4">
                <button wire:click="pilihKamar({{ $kamar->id }})"
                    class="w-full px-4 py-2 rounded text-white
                        {{ in_array($status, ['pending','reserved']) 
                            ? 'bg-gray-400 cursor-not-allowed' 
                            : 'bg-blue-600 hover:bg-blue-700' }}"
                    {{ in_array($status, ['pending','reserved']) ? 'disabled' : '' }}>
                    Pesan Sekarang
                </button>
            </div>

        </div>

        @endforeach

    </div>

    <!-- MODAL -->
    @if($showModal)
    <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">

        <div class="bg-white p-6 rounded-xl w-full max-w-md shadow-xl">

            <h3 class="text-lg font-bold mb-4">Reservasi: {{ $kamarDipilih->nama_kamar }}</h3>

            <form wire:submit.prevent="reservasi">

                <label class="block mb-2 font-medium">Check-in</label>
                <input type="date" wire:model="check_in" class="w-full border rounded px-3 py-2 mb-3">

                <label class="block mb-2 font-medium">Check-out</label>
                <input type="date" wire:model="check_out" class="w-full border rounded px-3 py-2 mb-3">

                @if($total_harga > 0)
                <div class="p-3 bg-blue-50 rounded mb-3">
                    <p class="font-medium">Total Harga:</p>
                    <p class="text-blue-600 font-bold">
                        Rp {{ number_format($total_harga, 0, ',', '.') }}
                    </p>
                </div>
                @endif

                <div class="flex justify-end space-x-3">
                    <button type="button" wire:click="$set('showModal', false)"
                        class="px-4 py-2 bg-gray-300 rounded">Batal</button>

                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Konfirmasi
                    </button>
                </div>

            </form>

        </div>

    </div>
    @endif

</div>