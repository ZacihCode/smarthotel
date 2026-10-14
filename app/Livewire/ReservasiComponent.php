<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Kamar;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Auth;

#[\Livewire\Attributes\Layout('client.layouts.app')]
class ReservasiComponent extends Component
{
    public $kamarDipilih;
    public $check_in, $check_out;
    public $total_harga = 0;
    public $showModal = false;

    public function pilihKamar($id)
    {
        $this->kamarDipilih = Kamar::findOrFail($id);
        $this->reset(['check_in', 'check_out', 'total_harga']);
        $this->showModal = true;
    }

    public function updatedCheckOut()
    {
        if ($this->check_in && $this->check_out) {
            $days = (strtotime($this->check_out) - strtotime($this->check_in)) / 86400;

            $this->total_harga = $days > 0
                ? $days * $this->kamarDipilih->harga
                : 0;
        }
    }

    public function reservasi()
    {
        $this->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        Reservasi::create([
            'user_id' => Auth::id(),
            'kamar_id' => $this->kamarDipilih->id,
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,
            'total_harga' => $this->total_harga,
            'status' => 'menunggu',
        ]);

        $this->showModal = false;
        session()->flash('success', 'Reservasi berhasil dibuat! Status: Menunggu persetujuan.');
    }

    public function cekKetersediaan($kamarId)
    {
        return Reservasi::where('kamar_id', $kamarId)
            ->whereIn('status', ['menunggu', 'disetujui'])
            ->exists();
    }

    public function render()
    {
        $kamars = Kamar::all();
        return view('livewire.reservasi-component', compact('kamars'));
    }
}
