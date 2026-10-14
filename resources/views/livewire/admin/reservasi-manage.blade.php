<div class="p-6">

    @if (session('success'))
    <div class="p-3 mb-4 bg-green-500 text-white rounded">
        {{ session('success') }}
    </div>
    @endif

    <h2 class="text-xl font-bold mb-4">Manajemen Reservasi</h2>

    <!-- Search & Filter -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
        <input type="text" wire:model="search" placeholder="Cari nama tamu..."
            class="px-4 py-2 rounded border w-full sm:w-64">

        <select wire:model="filterStatus"
            class="px-4 py-2 rounded border w-full sm:w-48">
            <option value="">Semua Status</option>
            <option value="menunggu">Menunggu</option>
            <option value="disetujui">Disetujui</option>
            <option value="ditolak">Ditolak</option>
            <option value="selesai">Selesai</option>
        </select>
    </div>

    <!-- TABEL -->
    <div class="overflow-x-auto bg-white rounded shadow border">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Tamu</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Kamar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Check-in</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Check-out</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($reservasis as $r)
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4">{{ $r->user->name }}</td>
                    <td class="px-6 py-4">{{ $r->kamar->nama_kamar }}</td>

                    <td class="px-6 py-4">{{ $r->check_in }}</td>
                    <td class="px-6 py-4">{{ $r->check_out }}</td>

                    <td class="px-6 py-4 text-blue-700 font-semibold">
                        Rp {{ number_format($r->total_harga, 0, ',', '.') }}
                    </td>

                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs rounded-full
                            @if($r->status == 'menunggu') bg-yellow-100 text-yellow-700
                            @elseif($r->status == 'disetujui') bg-green-100 text-green-700
                            @elseif($r->status == 'ditolak') bg-red-100 text-red-700
                            @else bg-blue-100 text-blue-700 @endif">
                            {{ ucfirst($r->status) }}
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex space-x-3">
                            <button wire:click="edit({{ $r->id }})"
                                class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-edit"></i>
                            </button>

                            <button wire:click="confirmDelete({{ $r->id }})"
                                class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="p-4">
            {{ $reservasis->links() }}
        </div>
    </div>

    <!-- MODAL EDIT STATUS -->
    @if ($showEditModal)
    <div class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50">

        <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-xl">
            <h3 class="text-lg font-bold mb-4">Ubah Status Reservasi</h3>

            <select wire:model="status" class="w-full border rounded px-3 py-2 mb-4">
                <option value="menunggu">Menunggu</option>
                <option value="disetujui">Disetujui</option>
                <option value="ditolak">Ditolak</option>
                <option value="selesai">Selesai</option>
            </select>

            <div class="flex justify-end space-x-3">
                <button wire:click="$set('showEditModal', false)"
                    class="px-4 py-2 bg-gray-300 rounded">Batal</button>

                <button wire:click="updateStatus"
                    class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
            </div>
        </div>

    </div>
    @endif

    <!-- MODAL DELETE -->
    @if ($confirmingDelete)
    <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">

        <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-sm">

            <h3 class="text-lg font-bold mb-4">Konfirmasi Hapus</h3>
            <p class="text-gray-600 mb-4">Yakin ingin menghapus reservasi ini?</p>

            <div class="flex justify-end space-x-3">
                <button wire:click="$set('confirmingDelete', false)"
                    class="px-4 py-2 bg-gray-300 rounded">Batal</button>

                <button wire:click="delete"
                    class="px-4 py-2 bg-red-600 text-white rounded">Hapus</button>
            </div>

        </div>

    </div>
    @endif

</div>