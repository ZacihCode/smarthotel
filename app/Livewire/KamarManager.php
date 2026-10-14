<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Kamar;
use Illuminate\Support\Facades\Storage;

#[\Livewire\Attributes\Layout('admin.layouts.app')]
class KamarManager extends Component
{
    use WithPagination, WithFileUploads;

    public $kamar_id;
    public $nama_kamar, $tipe, $harga, $jumlah_bed, $deskripsi, $foto;

    public $fotoFile; // <- file upload baru
    public $search = '';
    public $editMode = false;
    public $kamarIdBeingEdited;

    public $selectedKamar = [];
    public $selectAll = false;

    public $confirmingDelete = false;
    public $confirmingBulkDelete = false;
    public $kamarIdToDelete;

    public $showModal = false;

    protected $rules = [
        'nama_kamar' => 'required|string|max:255',
        'tipe'       => 'required|string|max:255',
        'harga'      => 'required|integer|min:0',
        'jumlah_bed' => 'required|integer|min:1',
        'deskripsi'  => 'nullable|string',
        'fotoFile'   => 'nullable|image|max:2048'
    ];

    public function resetForm()
    {
        $this->reset(['nama_kamar', 'tipe', 'harga', 'jumlah_bed', 'deskripsi', 'foto', 'fotoFile']);
        $this->resetValidation();
        $this->editMode = false;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        // Upload foto baru jika ada
        if ($this->fotoFile) {
            $path = $this->fotoFile->store('kamar', 'public');
        } else {
            $path = $this->foto; // tetap gunakan foto lama jika tidak upload baru
        }

        if ($this->editMode) {
            $kamar = Kamar::findOrFail($this->kamarIdBeingEdited);

            // hapus foto lama jika upload baru
            if ($this->fotoFile && $kamar->foto && Storage::disk('public')->exists($kamar->foto)) {
                Storage::disk('public')->delete($kamar->foto);
            }

            $kamar->update([
                'nama_kamar' => $this->nama_kamar,
                'tipe'       => $this->tipe,
                'harga'      => $this->harga,
                'jumlah_bed' => $this->jumlah_bed,
                'deskripsi'  => $this->deskripsi,
                'foto'       => $path
            ]);
        } else {
            Kamar::create([
                'nama_kamar' => $this->nama_kamar,
                'tipe'       => $this->tipe,
                'harga'      => $this->harga,
                'jumlah_bed' => $this->jumlah_bed,
                'deskripsi'  => $this->deskripsi,
                'foto'       => $path
            ]);
        }

        $this->resetForm();
        $this->showModal = false;
    }


    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);
        $this->fill($kamar->toArray());
        $this->editMode = true;
        $this->kamarIdBeingEdited = $id;
        $this->showModal = true;
    }

    public function confirmDelete($id)
    {
        $this->confirmingDelete = true;
        $this->kamarIdToDelete = $id;
    }

    public function deleteKamarConfirmed()
    {
        $kamar = Kamar::findOrFail($this->kamarIdToDelete);

        if ($kamar->foto && Storage::disk('public')->exists($kamar->foto)) {
            Storage::disk('public')->delete($kamar->foto);
        }

        $kamar->delete();
        $this->confirmingDelete = false;
    }

    public function render()
    {
        $kamars = Kamar::where('nama_kamar', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('livewire.kamar-manager', compact('kamars'));
    }
}
