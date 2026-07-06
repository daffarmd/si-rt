<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warga extends Model
{
    use HasFactory;
 
    protected $table = 'wargas';
 
    protected $fillable = [
        'kartu_keluarga_id', 'nik', 'nama', 'jenis_kelamin', 'tempat_lahir',
        'tanggal_lahir', 'agama', 'pekerjaan', 'status_perkawinan',
        'hubungan_keluarga', 'foto_ktp',
    ];
 
    public function kartuKeluarga()
    {
        return $this->belongsTo(KartuKeluarga::class);
    }
 
    public function surat()
    {
        return $this->hasMany(Surat::class);
    }
 
    public function iuran()
    {
        return $this->hasMany(Iuran::class);
    }
}
