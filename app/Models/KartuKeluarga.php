<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KartuKeluarga extends Model
{
    use HasFactory;
    
    protected $table = 'kartu_keluargas';

    protected $fillable = [
        'no_kk',
        'kepala_keluarga',
        'alamat',
        'rt',
        'rw',
    ];

    public function anggota()
    {
        return $this->hasMany(Warga::class, 'kartu_keluarga_id');
    }
}
