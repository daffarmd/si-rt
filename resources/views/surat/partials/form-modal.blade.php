<div class="p-6">
  <div class="flex justify-between mb-5">
    <h3 class="font-bold text-lg text-slate-800">{{ isset($s) ? 'Edit' : 'Tambah' }} Surat</h3>
    <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600"><i class="ph ph-x text-2xl"></i></button>
  </div>

  <form method="POST" action="{{ isset($s) ? route('surat.update', $s->id) : route('surat.store') }}">
    @csrf
    @if(isset($s)) @method('PUT') @endif

    <div class="space-y-4 mb-4">
      <div>
        <label class="block text-xs font-semibold text-slate-500 mb-1">Warga</label>
        <select required name="warga_id" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
          @foreach($wargaList as $w)
            <option value="{{ $w->id }}" {{ ($s->warga_id ?? null) == $w->id ? 'selected' : '' }}>{{ $w->nama }} ({{ $w->nik }})</option>
          @endforeach
        </select>
      </div>
      <div><label class="block text-xs font-semibold text-slate-500 mb-1">Jenis Surat</label><input required name="jenis_surat" value="{{ old('jenis_surat', $s->jenis_surat ?? '') }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm"></div>
      <div><label class="block text-xs font-semibold text-slate-500 mb-1">Keperluan</label><textarea required name="keperluan" rows="2" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm">{{ old('keperluan', $s->keperluan ?? '') }}</textarea></div>
      <div class="grid grid-cols-2 gap-4">
        <div><label class="block text-xs font-semibold text-slate-500 mb-1">Tanggal Pengajuan</label><input required name="tanggal_pengajuan" type="date" value="{{ old('tanggal_pengajuan', $s->tanggal_pengajuan ?? '') }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm"></div>
        <div>
          <label class="block text-xs font-semibold text-slate-500 mb-1">Status</label>
          <select required name="status" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
            <option value="diajukan" {{ ($s->status ?? '') === 'diajukan' ? 'selected' : '' }}>Diajukan</option>
            <option value="diproses" {{ ($s->status ?? '') === 'diproses' ? 'selected' : '' }}>Diproses</option>
            <option value="selesai" {{ ($s->status ?? '') === 'selesai' ? 'selected' : '' }}>Selesai</option>
          </select>
        </div>
      </div>
    </div>

    <div class="flex justify-end gap-2">
      <button type="button" onclick="closeModal()" class="px-4 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-50 border border-slate-200">Batal</button>
      <button type="submit" class="px-4 py-2 rounded-lg text-sm font-medium bg-primary-600 text-white hover:bg-primary-700 shadow shadow-primary-500/20">Simpan</button>
    </div>
  </form>
</div>
