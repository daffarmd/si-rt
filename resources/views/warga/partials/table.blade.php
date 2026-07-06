<div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-left">
      <thead class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
        <tr>
          <th class="px-4 py-3">Nama / NIK</th>
          <th class="px-4 py-3">No. KK</th>
          <th class="px-4 py-3">Jenis Kelamin</th>
          <th class="px-4 py-3">Pekerjaan</th>
          <th class="px-4 py-3">Hubungan</th>
          <th class="px-4 py-3">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($warga as $w)
          <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
            <td class="px-4 py-3 whitespace-nowrap">
              <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-xs font-bold overflow-hidden">
                  @if($w->foto_ktp)
                    <img src="{{ asset('storage/'.$w->foto_ktp) }}" class="w-full h-full object-cover">
                  @else
                    {{ substr($w->nama, 0, 1) }}
                  @endif
                </div>
                <div>
                  <p class="text-sm font-semibold text-slate-800">{{ $w->nama }}</p>
                  <p class="text-xs text-slate-500">NIK: {{ $w->nik }}</p>
                </div>
              </div>
            </td>
            <td class="px-4 py-3 text-sm text-slate-600">{{ $w->kartuKeluarga->no_kk ?? '-' }}</td>
            <td class="px-4 py-3 text-sm text-slate-600">{{ $w->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            <td class="px-4 py-3 text-sm text-slate-600">{{ $w->pekerjaan }}</td>
            <td class="px-4 py-3 text-sm text-slate-600">{{ $w->hubungan_keluarga }}</td>
            <td class="px-4 py-3 text-sm">
              <div class="flex items-center gap-2">
                @if(auth()->user()->role === 'admin')
                  <button onclick="openModalRemote('{{ route('warga.edit', $w->id) }}')" class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100" title="Ubah">
                    <i class="ph ph-pencil-simple text-lg"></i>
                  </button>
                  <form method="POST" action="{{ route('warga.destroy', $w->id) }}" onsubmit="return confirm('Hapus data warga ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100" title="Hapus">
                      <i class="ph ph-trash text-lg"></i>
                    </button>
                  </form>
                @endif
                <button onclick="openModalSmRemote('{{ route('warga.show', $w->id) }}')" class="p-2 rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200" title="Detail">
                  <i class="ph ph-eye text-lg"></i>
                </button>
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
