<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iuran extends Model
{
    protected $table = 'iurans';

    protected $fillable = [
        'warga_id', 'bulan', 'tahun', 'jumlah', 'status_bayar', 'tanggal_bayar',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}
