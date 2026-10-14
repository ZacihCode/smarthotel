<div>
    <div class="bg-white rounded-lg shadow mb-6">
        <!-- Header -->
        <div class="p-4 border-b flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div>
                <h3 class="font-semibold text-gray-800 text-lg">Manajemen User</h3>
                <p class="text-sm text-gray-500 mt-1">Kelola semua akun pengguna (Admin, Guru, dan Murid)</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-2">
                <input wire:model.lazy="search" type="text" placeholder="Cari User..."
                    class="bg-gray-100 rounded-lg px-4 py-2 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full sm:w-48">
                <button wire:click="resetForm"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah User
                </button>
            </div>
        </div>

        <!-- Tabel Desktop -->
        <div class="hidden lg:block overflow-x-auto">
            @if(count($selectedUsers) > 0)
            <button wire:click="confirmBulkDelete"
                class="group relative inline-flex items-center gap-2 px-4 py-2 mb-4 ml-6
                bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 
                text-white font-medium text-sm rounded-lg shadow-md hover:shadow-lg 
                transform hover:scale-[1.02] active:scale-95
                transition-all duration-150 ease-in-out
                border border-red-400/20 hover:border-red-300/30
                focus:outline-none focus:ring-2 focus:ring-red-500/30">

                <svg class="w-4 h-4 group-hover:rotate-6 transition-transform duration-150"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>

                <span class="relative flex items-center">
                    Hapus Terpilih
                    <span class="inline-flex items-center justify-center w-5 h-5 ml-1.5 bg-red-700/60 rounded-full text-xs font-semibold group-hover:bg-red-800/70 transition-colors duration-150">
                        {{ count($selectedUsers) }}
                    </span>
                </span>
            </button>
            @endif

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <input type="checkbox" wire:model="selectAll" wire:click="toggleSelectAll" class="rounded border-gray-300">
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <input type="checkbox" wire:model="selectedUsers" wire:change="$refresh" :value="{{ $user->id }}" />
                        </td>
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4 capitalize">{{ $user->role }}</td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <button wire:click="edit({{ $user->id }})" class="text-green-600 hover:text-green-900 p-1"><i class="fas fa-edit"></i></button>
                                <button wire:click="confirmDelete({{ $user->id }})" class="text-red-600 hover:text-red-900 p-1"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4 px-4">
                {{ $users->links() }}
            </div>
        </div>

        <!-- Kartu Mobile -->
        <div class="lg:hidden p-4">
            @if(count($selectedUsers) > 0)
            <div class="mb-4">
                <button wire:click="confirmBulkDelete"
                    class="w-full bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium shadow hover:bg-red-700 transition">
                    <i class="fas fa-trash mr-1"></i> Hapus Terpilih ({{ count($selectedUsers) }})
                </button>
            </div>
            @endif

            <div class="mb-3">
                <label class="inline-flex items-center space-x-2">
                    <input type="checkbox" wire:model="selectAll" wire:click="toggleSelectAll" class="rounded border-gray-300">
                    <span class="text-sm text-gray-700">Pilih Semua</span>
                </label>
            </div>

            <div class="space-y-4">
                @foreach ($users as $user)
                <div class="bg-white border rounded-lg p-4">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <div class="text-xs text-gray-500 uppercase tracking-wider">Nama</div>
                            <span class="text-sm font-medium text-blue-600">{{ $user->name }}</span>
                        </div>
                        <input type="checkbox" wire:model="selectedUsers" wire:change="$refresh" :value="{{ $user->id }}" />
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-3">
                        <div>
                            <div class="text-xs text-gray-500 uppercase tracking-wider">Email</div>
                            <div class="text-sm text-gray-800 mt-1">{{ $user->email }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500 uppercase tracking-wider">Role</div>
                            <div class="text-sm font-medium text-gray-900 mt-1 capitalize">{{ $user->role }}</div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pt-3 border-t border-gray-200">
                        <div class="flex space-x-3">
                            <button wire:click="edit({{ $user->id }})" class="text-green-600 hover:text-green-900 text-sm flex items-center">
                                <i class="fas fa-edit mr-1"></i><span>Edit</span>
                            </button>
                            <button wire:click="confirmDelete({{ $user->id }})" class="text-red-600 hover:text-red-900 text-sm flex items-center">
                                <i class="fas fa-trash mr-1"></i><span>Hapus</span>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>

        <!-- Modal Form -->
        @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg w-full max-w-md">
                <h3 class="text-lg font-bold mb-4">{{ $editMode ? 'Edit User' : 'Tambah User' }}</h3>
                <form wire:submit.prevent="save">
                    <input wire:model="name" type="text" placeholder="Nama Lengkap" class="w-full mb-3 border px-3 py-2 rounded" />
                    @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

                    <input wire:model="email" type="email" placeholder="Email" class="w-full mb-3 border px-3 py-2 rounded" />
                    @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

                    <input wire:model="password" type="password" placeholder="Password (kosongkan jika tidak diubah)" class="w-full mb-3 border px-3 py-2 rounded" />
                    @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

                    <select wire:model="role" class="w-full mb-3 border px-3 py-2 rounded">
                        <option value="">Pilih Role</option>
                        <option value="ADMIN">Admin</option>
                        <option value="TAMU">Tamu</option>
                    </select>
                    @error('role') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

                    <div class="flex justify-end space-x-2">
                        <button wire:click="$set('showModal', false)" type="button" class="bg-gray-300 px-4 py-2 rounded">Batal</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        <!-- Modal Konfirmasi Hapus -->
        @if($confirmingDelete)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">

            <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-sm transform"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95">

                <h2 class="text-lg font-bold mb-4 text-gray-800">Konfirmasi Hapus</h2>
                <p class="mb-6 text-gray-600">Yakin ingin menghapus user ini? Tindakan ini tidak dapat dibatalkan.</p>
                <div class="flex justify-end space-x-3">
                    <button wire:click="$set('confirmingDelete', false)" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                    <button wire:click="deleteUserConfirmed" class="px-4 py-2 bg-red-600 text-white rounded">Hapus</button>
                </div>
            </div>
        </div>
        @endif

        <!-- Modal Konfirmasi Hapus Banyak -->
        @if($confirmingBulkDelete)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-sm transform"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95">

                <h2 class="text-lg font-bold mb-4 text-gray-800">Hapus Beberapa User</h2>
                <p class="mb-6 text-gray-600">
                    Apakah kamu yakin ingin menghapus {{ count($selectedUsers) }} user terpilih?
                </p>
                <div class="flex justify-end space-x-3">
                    <button wire:click="$set('confirmingBulkDelete', false)" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                    <button wire:click="deleteSelectedConfirmed" class="px-4 py-2 bg-red-600 text-white rounded">Hapus</button>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>