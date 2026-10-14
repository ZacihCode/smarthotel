<div>
    <div class="bg-white rounded-lg shadow mb-6">
        <!-- Header -->
        <div class="p-4 border-b flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div>
                <h3 class="font-semibold text-gray-800 text-lg">Kamar Management</h3>
                <p class="text-sm text-gray-500 mt-1">Kelola semua data kamar hotel</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-2">
                <input wire:model.lazy="search" type="text" placeholder="Cari kamar..."
                    class="bg-gray-100 rounded-lg px-4 py-2 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full sm:w-48">

                <button wire:click="resetForm"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Kamar
                </button>
            </div>
        </div>

        <!-- Desktop Table -->
        <div class="hidden lg:block overflow-x-auto">

            @if(count($selectedKamar) > 0)
            <button wire:click="confirmBulkDelete"
                class="group relative inline-flex items-center gap-2 px-4 py-2 mb-4 ml-6
                bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 
                text-white font-medium text-sm rounded-lg shadow-md hover:shadow-lg 
                transform hover:scale-[1.02] active:scale-95
                transition-all duration-150 ease-in-out
                border border-red-400/20 hover:border-red-300/30">

                <svg class="w-4 h-4 group-hover:rotate-6 transition-transform duration-150"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>

                <span class="relative flex items-center">
                    Delete Selected
                    <span
                        class="inline-flex items-center justify-center w-5 h-5 ml-1.5 bg-red-700/60 rounded-full text-xs font-semibold group-hover:bg-red-800/70 transition-colors duration-150">
                        {{ count($selectedKamar) }}
                    </span>
                </span>
            </button>
            @endif

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            <input type="checkbox" wire:model="selectAll" wire:click="toggleSelectAll"
                                class="rounded border-gray-300" />
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Nama Kamar
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Tipe
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Harga
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Jumlah Bed
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Image
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Tanggal
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($kamars as $kamar)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <input type="checkbox" wire:model="selectedKamar" value="{{ $kamar->id }}" />
                        </td>
                        <td class="px-6 py-4">{{ $kamar->nama_kamar }}</td>
                        <td class="px-6 py-4">{{ $kamar->tipe }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">{{ $kamar->jumlah_bed }}</td>
                        <td class="px-6 py-4">
                            @if ($kamar->foto)
                            <img src="{{ asset('storage/' . $kamar->foto) }}" class="h-14 w-20 object-cover rounded shadow">
                            @else
                            <span class="text-gray-400 text-sm">No Image</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $kamar->created_at->format('d M Y') }}</td>

                        <td class="px-6 py-4">
                            <div class="flex space-x-3">
                                <button wire:click="edit({{ $kamar->id }})" class="text-green-600 hover:text-green-900 p-1">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button wire:click="confirmDelete({{ $kamar->id }})"
                                    class="text-red-600 hover:text-red-900 p-1">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $kamars->links() }}
            </div>
        </div>

        <!-- Mobile Card View -->
        <div class="lg:hidden p-4">

            @if(count($selectedKamar) > 0)
            <button wire:click="confirmBulkDelete"
                class="w-full bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium shadow hover:bg-red-700 transition">
                <i class="fas fa-trash mr-1"></i> Hapus Terpilih ({{ count($selectedKamar) }})
            </button>
            @endif

            <div class="mb-3">
                <label class="inline-flex items-center space-x-2">
                    <input type="checkbox" wire:model="selectAll" wire:click="toggleSelectAll"
                        class="rounded border-gray-300">
                    <span class="text-sm text-gray-700">Pilih Semua</span>
                </label>
            </div>

            <div class="space-y-4">
                @foreach ($kamars as $kamar)
                <div class="bg-white border rounded-lg p-4">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <div class="text-xs text-gray-500 uppercase">Nama Kamar</div>
                            <span class="text-sm font-medium text-blue-600">{{ $kamar->nama_kamar }}</span>
                        </div>
                        <input type="checkbox" wire:model="selectedKamar" value="{{ $kamar->id }}" />
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-3">
                        <div>
                            <div class="text-xs text-gray-500 uppercase">Tipe</div>
                            <div class="text-sm text-gray-800">{{ $kamar->tipe }}</div>
                        </div>

                        <div>
                            <div class="text-xs text-gray-500 uppercase">Harga</div>
                            <div class="text-sm text-gray-800">
                                Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                            </div>
                        </div>

                        <div>
                            <div class="text-xs text-gray-500 uppercase">Jumlah Bed</div>
                            <div class="text-sm text-gray-800">{{ $kamar->jumlah_bed }}</div>
                        </div>

                        <div>
                            <div class="text-xs text-gray-500 uppercase">Tanggal</div>
                            <div class="text-sm text-gray-800">
                                {{ $kamar->created_at->format('d M Y') }}
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-3 border-t">
                        <div class="flex space-x-3">
                            <button wire:click="edit({{ $kamar->id }})"
                                class="text-green-600 hover:text-green-900 text-sm flex items-center">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </button>

                            <button wire:click="confirmDelete({{ $kamar->id }})"
                                class="text-red-600 hover:text-red-900 text-sm flex items-center">
                                <i class="fas fa-trash mr-1"></i>Hapus
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $kamars->links() }}
            </div>
        </div>

        <!-- Modal Tambah/Edit -->
        @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg w-full max-w-md">
                <h3 class="text-lg font-bold mb-4">{{ $editMode ? 'Edit Kamar' : 'Tambah Kamar' }}</h3>

                <form wire:submit.prevent="save">

                    <input wire:model="nama_kamar" type="text" placeholder="Nama Kamar"
                        class="w-full mb-3 border px-3 py-2 rounded" />
                    @error('nama_kamar') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

                    <input wire:model="tipe" type="text" placeholder="Tipe Kamar"
                        class="w-full mb-3 border px-3 py-2 rounded" />
                    @error('tipe') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

                    <input wire:model="harga" type="number" placeholder="Harga"
                        class="w-full mb-3 border px-3 py-2 rounded" />
                    @error('harga') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

                    <input wire:model="jumlah_bed" type="number" placeholder="Jumlah Bed"
                        class="w-full mb-3 border px-3 py-2 rounded" />
                    @error('jumlah_bed') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

                    <textarea wire:model="deskripsi" placeholder="Deskripsi"
                        class="w-full mb-3 border px-3 py-2 rounded"></textarea>
                    @error('deskripsi') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

                    <label class="block mb-2 font-medium">Foto Kamar</label>
                    <input type="file" wire:model="fotoFile" class="w-full border rounded px-3 py-2 mb-3">

                    @error('fotoFile')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror

                    @if ($fotoFile)
                    <p class="text-sm text-gray-600 mb-2">Preview:</p>
                    <img src="{{ $fotoFile->temporaryUrl() }}" class="h-28 rounded shadow mb-3">
                    @elseif ($foto)
                    <p class="text-sm text-gray-600 mb-2">Foto Saat Ini:</p>
                    <img src="{{ asset('storage/' . $foto) }}" class="h-28 rounded shadow mb-3">
                    @endif

                    <div class="flex justify-end space-x-2">
                        <button type="button" wire:click="$set('showModal', false)"
                            class="bg-gray-300 px-4 py-2 rounded">Batal</button>

                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                            Simpan
                        </button>
                    </div>

                </form>
            </div>
        </div>
        @endif

        <!-- Single Delete Modal -->
        <div x-data="{ showConfirm: @entangle('confirmingDelete') }" x-show="showConfirm" x-cloak
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

            <div @click.away="showConfirm = false"
                class="bg-white p-6 rounded-lg shadow-xl w-full max-w-sm">

                <h2 class="text-lg font-bold mb-4">Konfirmasi Hapus</h2>
                <p class="mb-6 text-gray-600">Yakin ingin menghapus kamar ini? Tindakan ini tidak bisa dibatalkan.</p>

                <div class="flex justify-end space-x-3">
                    <button @click="showConfirm = false" class="px-4 py-2 bg-gray-300 rounded">
                        Batal
                    </button>

                    <button wire:click="deleteKamarConfirmed" class="px-4 py-2 bg-red-600 text-white rounded">
                        Hapus
                    </button>
                </div>
            </div>
        </div>

        <!-- Bulk Delete Modal -->
        <div x-data="{ showConfirmBulk: @entangle('confirmingBulkDelete') }" x-show="showConfirmBulk" x-cloak
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

            <div @click.away="showConfirmBulk = false"
                class="bg-white p-6 rounded-lg shadow-xl w-full max-w-sm">

                <h2 class="text-lg font-bold mb-4">Hapus Beberapa Kamar</h2>
                <p class="mb-6 text-gray-600">
                    Apakah kamu yakin ingin menghapus {{ count($selectedKamar) }} kamar terpilih?
                </p>

                <div class="flex justify-end space-x-3">
                    <button @click="showConfirmBulk = false" class="px-4 py-2 bg-gray-300 rounded">
                        Batal
                    </button>

                    <button wire:click="deleteSelectedConfirmed" class="px-4 py-2 bg-red-600 text-white rounded">
                        Hapus
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>