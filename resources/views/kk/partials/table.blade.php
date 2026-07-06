<div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-left">
      <thead class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
        <tr>
          <th class="px-4 py-3">No. KK</th>
          <th class="px-4 py-3">Kepala Keluarga</th>
          <th class="px-4 py-3">Alamat</th>
          <th class="px-4 py-3 text-center">RT/RW</th>
          <th class="px-4 py-3">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($kk as $k)
          <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
            <td class="px-4 py-3 text-sm font-semibold text-slate-800">{{ $k->no_kk }}</td>
            <td class="px-4 py-3 text-sm text-slate-700">{{ $k->kepala_keluarga }}</td>
            <td class="px-4 py-3 text-sm text-slate-600">{{ $k->alamat }}</td>
            <td class="px-4 py-3 text-sm text-slate-600 text-center">{{ $k->rt }}/{{ $k->rw }}</td>
            <td class="px-4 py-3 text-sm">
              <div class="flex items-center gap-2">
                @if(auth()->user()->role === 'admin')
                  <button onclick="openModalRemote('{{ route('kk.edit', $k->id) }}')" class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100" title="Ubah">
                    <i class="ph ph-pencil-simple text-lg"></i>
                  </button>
                  <form method="POST" action="{{ route('kk.destroy', $k->id) }}" onsubmit="return confirm('Hapus data ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100" title="Hapus">
                      <i class="ph ph-trash text-lg"></i>
                    </button>
                  </form>
                @endif
                <button onclick="openModalSmRemote('{{ route('kk.show', $k->id) }}')" class="p-2 rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200" title="Detail">
                  <i class="ph ph-eye text-lg"></i>
                </button>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="px-4 py-6 text-center text-sm text-slate-400">Belum ada data.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
