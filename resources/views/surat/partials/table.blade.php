<div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-left">
      <thead class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
        <tr>
          <th class="px-4 py-3">Warga</th>
          <th class="px-4 py-3">Jenis Surat</th>
          <th class="px-4 py-3">Keperluan</th>
          <th class="px-4 py-3">Tanggal</th>
          <th class="px-4 py-3">Status</th>
          <th class="px-4 py-3">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($surat as $s)
          <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
            <td class="px-4 py-3 text-sm font-semibold text-slate-800">{{ $s->warga->nama ?? '-' }}</td>
            <td class="px-4 py-3 text-sm text-slate-700">{{ $s->jenis_surat }}</td>
            <td class="px-4 py-3 text-sm text-slate-600 max-w-xs truncate" title="{{ $s->keperluan }}">{{ $s->keperluan }}</td>
            <td class="px-4 py-3 text-sm text-slate-600 whitespace-nowrap">{{ \Carbon\Carbon::parse($s->tanggal_pengajuan)->translatedFormat('d M Y') }}</td>
            <td class="px-4 py-3"><x-badge-status :status="$s->status" /></td>
            <td class="px-4 py-3 text-sm">
              <div class="flex items-center gap-2">
                <a href="{{ route('surat.cetak', $s->id) }}" target="_blank" class="p-2 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100" title="Generate PDF">
                  <i class="ph ph-file-pdf text-lg"></i>
                </a>
                @if(auth()->user()->role === 'admin')
                  <button onclick="openModalRemote('{{ route('surat.edit', $s->id) }}')" class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100" title="Ubah">
                    <i class="ph ph-pencil-simple text-lg"></i>
                  </button>
                  <form method="POST" action="{{ route('surat.destroy', $s->id) }}" onsubmit="return confirm('Hapus surat ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100" title="Hapus">
                      <i class="ph ph-trash text-lg"></i>
                    </button>
                  </form>
                @endif
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" class="px-4 py-6 text-center text-sm text-slate-400">Belum ada data.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
