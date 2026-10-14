<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kamar',
        'tipe',
        'harga',
        'jumlah_bed',
        'deskripsi',
        'foto',
    ];

    public function reservasis()
    {
        return $this->hasMany(Reservasi::class);
    }
}
