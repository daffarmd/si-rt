<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Iuran;
use App\Models\KartuKeluarga;
use App\Models\Warga;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            ['label' => 'Kartu Keluarga', 'value' => KartuKeluarga::count(), 'icon' => 'ph-identification-card', 'clr' => 'text-primary-600 bg-primary-50'],
            ['label' => 'Total Warga',    'value' => Warga::count(),         'icon' => 'ph-users',                'clr' => 'text-emerald-600 bg-emerald-50'],
            ['label' => 'Surat Bulan Ini','value' => Surat::whereMonth('tanggal_pengajuan', now()->month)->count(), 'icon' => 'ph-envelope-simple', 'clr' => 'text-amber-600 bg-amber-50'],
            ['label' => 'Iuran Lunas',    'value' => Iuran::where('status_bayar', 'lunas')->count(), 'icon' => 'ph-coins', 'clr' => 'text-sky-600 bg-sky-50'],
        ];

        $lastSurat = Surat::with('warga')->latest('id')->take(4)->get();
        $lastIuran = Iuran::with('warga')->latest('id')->take(4)->get();

        return view('dashboard.index', compact('stats', 'lastSurat', 'lastIuran'));
    }
}
