{{-- Dipanggil via AJAX (fetch) dari app.js, lalu disuntikkan ke #modal-content --}}
<div class="p-6">
  <div class="flex items-center justify-between mb-5">
    <h3 class="font-bold text-lg text-slate-800">{{ isset($k) ? 'Edit' : 'Tambah' }} Kartu Keluarga</h3>
    <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600"><i class="ph ph-x text-2xl"></i></button>
  </div>

  <form method="POST" action="{{ isset($k) ? route('kk.update', $k->id) : route('kk.store') }}">
    @csrf
    @if(isset($k)) @method('PUT') @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
      <div>
        <label class="block text-xs font-semibold text-slate-500 mb-1">No. KK</label>
        <input required name="no_kk" value="{{ old('no_kk', $k->no_kk ?? '') }}"
               class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm">
      </div>
      <div>
        <label class="block text-xs font-semibold text-slate-500 mb-1">Kepala Keluarga</label>
        <input required name="kepala_keluarga" value="{{ old('kepala_keluarga', $k->kepala_keluarga ?? '') }}"
               class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm">
      </div>
      <div class="sm:col-span-2">
        <label class="block text-xs font-semibold text-slate-500 mb-1">Alamat</label>
        <textarea required name="alamat" rows="2"
                  class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm">{{ old('alamat', $k->alamat ?? '') }}</textarea>
      </div>
      <div>
        <label class="block text-xs font-semibold text-slate-500 mb-1">RT</label>
        <input required name="rt" value="{{ old('rt', $k->rt ?? '') }}"
               class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm">
      </div>
      <div>
        <label class="block text-xs font-semibold text-slate-500 mb-1">RW</label>
        <input required name="rw" value="{{ old('rw', $k->rw ?? '') }}"
               class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm">
      </div>
    </div>

    <div class="flex justify-end gap-2">
      <button type="button" onclick="closeModal()" class="px-4 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-50 border border-slate-200">Batal</button>
      <button type="submit" class="px-4 py-2 rounded-lg text-sm font-medium bg-primary-600 text-white hover:bg-primary-700 shadow shadow-primary-500/20">Simpan</button>
    </div>
  </form>
</div>
