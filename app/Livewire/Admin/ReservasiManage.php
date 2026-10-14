<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reservasi;

#[\Livewire\Attributes\Layout('admin.layouts.app')]
class ReservasiManage extends Component
{
    use WithPagination;

    public $reservasiId;
    public $status;
    public $search = '';
    public $filterStatus = '';

    public $confirmingDelete = false;
    public $reservasiIdToDelete;

    public $showEditModal = false;

    protected $rules = [
        'status' => 'required|in:menunggu,disetujui,ditolak,selesai',
    ];

    public function edit($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        $this->reservasiId = $id;
        $this->status = $reservasi->status;

        $this->showEditModal = true;
    }

    public function updateStatus()
    {
        $this->validate();

        Reservasi::findOrFail($this->reservasiId)->update([
            'status' => $this->status,
        ]);

        $this->showEditModal = false;
        session()->flash('success', 'Status reservasi telah diperbarui.');
    }

    public function confirmDelete($id)
    {
        $this->reservasiIdToDelete = $id;
        $this->confirmingDelete = true;
    }

    public function delete()
    {
        Reservasi::findOrFail($this->reservasiIdToDelete)->delete();

        $this->confirmingDelete = false;
        session()->flash('success', 'Reservasi berhasil dihapus.');
    }

    public function render()
    {
        $reservasis = Reservasi::with(['user', 'kamar'])
            ->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterStatus != '', function ($q) {
                $q->where('status', $this->filterStatus);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.reservasi-manage', compact('reservasis'));
    }
}
