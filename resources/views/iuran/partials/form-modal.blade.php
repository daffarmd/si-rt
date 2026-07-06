<div class="p-6">
  <div class="flex justify-between mb-5">
    <h3 class="font-bold text-lg text-slate-800">{{ isset($i) ? 'Edit' : 'Tambah' }} Iuran</h3>
    <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600"><i class="ph ph-x text-2xl"></i></button>
  </div>

  <form method="POST" action="{{ isset($i) ? route('iuran.update', $i->id) : route('iuran.store') }}">
    @csrf
    @if(isset($i)) @method('PUT') @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
      <div class="sm:col-span-2">
        <label class="block text-xs font-semibold text-slate-500 mb-1">Warga</label>
        <select required name="warga_id" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
          @foreach($wargaList as $w)
            <option value="{{ $w->id }}" {{ ($i->warga_id ?? null) == $w->id ? 'selected' : '' }}>{{ $w->nama }}</option>
          @endforeach
        </select>
      </div>
      <div><label class="block text-xs font-semibold text-slate-500 mb-1">Bulan</label><input required name="bulan" value="{{ old('bulan', $i->bulan ?? '') }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm"></div>
      <div><label class="block text-xs font-semibold text-slate-500 mb-1">Tahun</label><input required name="tahun" type="number" value="{{ old('tahun', $i->tahun ?? date('Y')) }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm"></div>
      <div><label class="block text-xs font-semibold text-slate-500 mb-1">Jumlah (Rp)</label><input required name="jumlah" type="number" value="{{ old('jumlah', $i->jumlah ?? 50000) }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm"></div>
      <div>
        <label class="block text-xs font-semibold text-slate-500 mb-1">Status Bayar</label>
        <select required name="status_bayar" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
          <option value="lunas" {{ ($i->status_bayar ?? '') === 'lunas' ? 'selected' : '' }}>Lunas</option>
          <option value="belum_lunas" {{ ($i->status_bayar ?? '') === 'belum_lunas' ? 'selected' : '' }}>Belum Lunas</option>
        </select>
      </div>
      <div class="sm:col-span-2"><label class="block text-xs font-semibold text-slate-500 mb-1">Tanggal Bayar</label><input name="tanggal_bayar" type="date" value="{{ old('tanggal_bayar', $i->tanggal_bayar ?? '') }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm"></div>
    </div>

    <div class="flex justify-end gap-2">
      <button type="button" onclick="closeModal()" class="px-4 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-50 border border-slate-200">Batal</button>
      <button type="submit" class="px-4 py-2 rounded-lg text-sm font-medium bg-primary-600 text-white hover:bg-primary-700 shadow shadow-primary-500/20">Simpan</button>
    </div>
  </form>
</div>
