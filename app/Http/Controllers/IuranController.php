<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\Warga;
use Illuminate\Http\Request;

class IuranController extends Controller
{
    public function index(Request $request)
    {
        $iuran = Iuran::with('warga')
            ->when($request->q, fn($q) => $q->where('bulan', 'like', "%{$request->q}%"))
            ->when($request->status, fn($q) => $q->where('status_bayar', $request->status))
            ->orderByDesc('id')
            ->paginate(5)
            ->withQueryString();

        return view('iuran.index', compact('iuran'));
    }

    public function create()
    {
        $wargaList = Warga::orderBy('nama')->get();
        return view('iuran.partials.form-modal', compact('wargaList'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Iuran::create($data);

        return redirect()->route('iuran.index')->with('success', 'Iuran berhasil ditambahkan');
    }

    public function edit(Iuran $iuran)
    {
        $i = $iuran;
        $wargaList = Warga::orderBy('nama')->get();
        return view('iuran.partials.form-modal', compact('i', 'wargaList'));
    }

    public function update(Request $request, Iuran $iuran)
    {
        $data = $this->validated($request);
        $iuran->update($data);

        return redirect()->route('iuran.index')->with('success', 'Iuran berhasil diperbarui');
    }

    public function destroy(Iuran $iuran)
    {
        $iuran->delete();
        return redirect()->route('iuran.index')->with('success', 'Iuran berhasil dihapus');
    }

    public function export()
    {
        $filename = 'iuran.csv';
        $iuran = Iuran::with('warga')->get();

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function () use ($iuran) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Nama', 'Bulan', 'Tahun', 'Jumlah', 'Status Bayar', 'Tanggal Bayar']);
            foreach ($iuran as $i) {
                fputcsv($handle, [$i->warga->nama ?? '-', $i->bulan, $i->tahun, $i->jumlah, $i->status_bayar, $i->tanggal_bayar]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function validated(Request $request)
    {
        return $request->validate([
            'warga_id'      => 'required|exists:wargas,id',
            'bulan'         => 'required|string',
            'tahun'         => 'required|integer',
            'jumlah'        => 'required|integer|min:0',
            'status_bayar'  => 'required|in:lunas,belum_lunas',
            'tanggal_bayar' => 'nullable|date',
        ]);
    }
}
