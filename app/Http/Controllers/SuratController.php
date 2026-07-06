<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Warga;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index(Request $request)
    {
        $surat = Surat::with('warga')
            ->when($request->q, fn($q) => $q->where('jenis_surat', 'like', "%{$request->q}%")
                                             ->orWhere('keperluan', 'like', "%{$request->q}%"))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->orderByDesc('id')
            ->paginate(5)
            ->withQueryString();

        return view('surat.index', compact('surat'));
    }

    public function create()
    {
        $wargaList = Warga::orderBy('nama')->get();
        return view('surat.partials.form-modal', compact('wargaList'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Surat::create($data);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil ditambahkan');
    }

    public function edit(Surat $surat)
    {
        $s = $surat;
        $wargaList = Warga::orderBy('nama')->get();
        return view('surat.partials.form-modal', compact('s', 'wargaList'));
    }

    public function update(Request $request, Surat $surat)
    {
        $data = $this->validated($request);
        $surat->update($data);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil diperbarui');
    }

    public function destroy(Surat $surat)
    {
        $surat->delete();
        return redirect()->route('surat.index')->with('success', 'Surat berhasil dihapus');
    }

    public function cetak(Surat $surat)
    {
        $surat->load('warga');
        return view('surat.cetak', compact('surat'));
    }

    private function validated(Request $request)
    {
        return $request->validate([
            'warga_id'          => 'required|exists:wargas,id',
            'jenis_surat'       => 'required|string',
            'keperluan'         => 'required|string',
            'tanggal_pengajuan' => 'required|date',
            'status'            => 'required|in:diajukan,diproses,selesai',
        ]);
    }
}
