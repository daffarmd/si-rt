<?php

namespace App\Http\Controllers;

use App\Models\KartuKeluarga;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $warga = Warga::with('kartuKeluarga')
            ->when($request->q, fn($q) => $q->where('nama', 'like', "%{$request->q}%")
                                             ->orWhere('nik', 'like', "%{$request->q}%"))
            ->when($request->jk, fn($q) => $q->where('jenis_kelamin', $request->jk))
            ->orderByDesc('id')
            ->paginate(5)
            ->withQueryString();

        return view('warga.index', compact('warga'));
    }

    public function create()
    {
        $kkList = KartuKeluarga::orderBy('kepala_keluarga')->get();
        return view('warga.partials.form-modal', compact('kkList'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('foto_ktp')) {
            $data['foto_ktp'] = $request->file('foto_ktp')->store('warga', 'public');
        }

        Warga::create($data);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan');
    }

    public function edit(Warga $warga)
    {
        $w = $warga;
        $kkList = KartuKeluarga::orderBy('kepala_keluarga')->get();
        return view('warga.partials.form-modal', compact('w', 'kkList'));
    }

    public function update(Request $request, Warga $warga)
    {
        $data = $this->validated($request, $warga->id);

        if ($request->hasFile('foto_ktp')) {
            if ($warga->foto_ktp) {
                Storage::disk('public')->delete($warga->foto_ktp);
            }
            $data['foto_ktp'] = $request->file('foto_ktp')->store('warga', 'public');
        }

        $warga->update($data);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui');
    }

    public function show(Warga $warga)
    {
        $w = $warga;
        return view('warga.partials.detail-modal', compact('w'));
    }

    public function destroy(Warga $warga)
    {
        if ($warga->foto_ktp) {
            Storage::disk('public')->delete($warga->foto_ktp);
        }
        $warga->delete();

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus');
    }

    public function export()
    {
        $filename = 'data_warga.csv';
        $warga = Warga::all();

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function () use ($warga) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['NIK', 'Nama', 'Jenis Kelamin', 'Tempat Lahir', 'Tanggal Lahir', 'Agama', 'Pekerjaan', 'Status Perkawinan', 'Hubungan']);
            foreach ($warga as $w) {
                fputcsv($handle, [$w->nik, $w->nama, $w->jenis_kelamin, $w->tempat_lahir, $w->tanggal_lahir, $w->agama, $w->pekerjaan, $w->status_perkawinan, $w->hubungan_keluarga]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function validated(Request $request, $ignoreId = null)
    {
        return $request->validate([
            'kartu_keluarga_id'  => 'required|exists:kartu_keluargas,id',
            'nik'                => 'required|string|unique:wargas,nik' . ($ignoreId ? ",{$ignoreId}" : ''),
            'nama'               => 'required|string',
            'jenis_kelamin'      => 'required|in:L,P',
            'tempat_lahir'       => 'required|string',
            'tanggal_lahir'      => 'required|date',
            'agama'              => 'required|string',
            'pekerjaan'          => 'required|string',
            'status_perkawinan'  => 'required|string',
            'hubungan_keluarga'  => 'required|string',
            'foto_ktp'           => 'nullable|image|max:2048',
        ]);
    }
}
