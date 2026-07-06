<?php

namespace App\Http\Controllers;

use App\Models\KartuKeluarga;
use Illuminate\Http\Request;

class KartuKeluargaController extends Controller
{
    public function index(Request $request)
    {
        $kk = KartuKeluarga::query()
            ->when($request->q, function ($q) use ($request) {
                $q->where('no_kk', 'like', "%{$request->q}%")
                  ->orWhere('kepala_keluarga', 'like', "%{$request->q}%");
            })
            ->orderByDesc('id')
            ->paginate(5)
            ->withQueryString();

        return view('kk.index', compact('kk'));
    }

    public function create()
    {
        // Dikembalikan sebagai partial (dipanggil via fetch/AJAX untuk mengisi modal)
        return view('kk.partials.form-modal');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'no_kk'           => 'required|string|unique:kartu_keluargas,no_kk',
            'kepala_keluarga' => 'required|string',
            'alamat'          => 'required|string',
            'rt'              => 'required|string',
            'rw'              => 'required|string',
        ]);

        KartuKeluarga::create($data);

        return redirect()->route('kk.index')->with('success', 'Data KK berhasil ditambahkan');
    }

    public function edit(KartuKeluarga $kk)
    {
        $k = $kk;
        return view('kk.partials.form-modal', compact('k'));
    }

    public function update(Request $request, KartuKeluarga $kk)
    {
        $data = $request->validate([
            'no_kk'           => 'required|string|unique:kartu_keluargas,no_kk,' . $kk->id,
            'kepala_keluarga' => 'required|string',
            'alamat'          => 'required|string',
            'rt'              => 'required|string',
            'rw'              => 'required|string',
        ]);

        $kk->update($data);

        return redirect()->route('kk.index')->with('success', 'Data KK berhasil diperbarui');
    }

    public function show(KartuKeluarga $kk)
    {
        $k = $kk->load('anggota');
        return view('kk.partials.detail-modal', compact('k'));
    }

    public function destroy(KartuKeluarga $kk)
    {
        $kk->delete(); // pastikan relasi warga di-handle (cascade / dihapus manual)
        return redirect()->route('kk.index')->with('success', 'Data KK berhasil dihapus');
    }
}
