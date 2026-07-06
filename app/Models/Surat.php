<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surats';

    protected $fillable = [
        'warga_id', 'jenis_surat', 'keperluan', 'tanggal_pengajuan', 'status',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}
