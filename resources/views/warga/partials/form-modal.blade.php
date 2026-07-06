<div class="p-6">
  <div class="flex justify-between mb-5">
    <h3 class="font-bold text-lg text-slate-800">{{ isset($w) ? 'Edit' : 'Tambah' }} Warga</h3>
    <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600"><i class="ph ph-x text-2xl"></i></button>
  </div>

  <form method="POST" action="{{ isset($w) ? route('warga.update', $w->id) : route('warga.store') }}" enctype="multipart/form-data">
    @csrf
    @if(isset($w)) @method('PUT') @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
      <div class="sm:col-span-2">
        <label class="block text-xs font-semibold text-slate-500 mb-1">Kartu Keluarga</label>
        <select required name="kartu_keluarga_id" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
          @foreach($kkList as $k)
            <option value="{{ $k->id }}" {{ ($w->kartu_keluarga_id ?? null) == $k->id ? 'selected' : '' }}>{{ $k->no_kk }} - {{ $k->kepala_keluarga }}</option>
          @endforeach
        </select>
      </div>
      <div><label class="block text-xs font-semibold text-slate-500 mb-1">NIK</label><input required name="nik" value="{{ old('nik', $w->nik ?? '') }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm"></div>
      <div><label class="block text-xs font-semibold text-slate-500 mb-1">Nama</label><input required name="nama" value="{{ old('nama', $w->nama ?? '') }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm"></div>
      <div>
        <label class="block text-xs font-semibold text-slate-500 mb-1">Jenis Kelamin</label>
        <select required name="jenis_kelamin" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
          <option value="L" {{ ($w->jenis_kelamin ?? '') === 'L' ? 'selected' : '' }}>Laki-laki</option>
          <option value="P" {{ ($w->jenis_kelamin ?? '') === 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
      </div>
      <div><label class="block text-xs font-semibold text-slate-500 mb-1">Tempat Lahir</label><input required name="tempat_lahir" value="{{ old('tempat_lahir', $w->tempat_lahir ?? '') }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm"></div>
      <div><label class="block text-xs font-semibold text-slate-500 mb-1">Tanggal Lahir</label><input required name="tanggal_lahir" type="date" value="{{ old('tanggal_lahir', $w->tanggal_lahir ?? '') }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm"></div>
      <div><label class="block text-xs font-semibold text-slate-500 mb-1">Agama</label><input required name="agama" value="{{ old('agama', $w->agama ?? '') }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm"></div>
      <div><label class="block text-xs font-semibold text-slate-500 mb-1">Pekerjaan</label><input required name="pekerjaan" value="{{ old('pekerjaan', $w->pekerjaan ?? '') }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm"></div>
      <div><label class="block text-xs font-semibold text-slate-500 mb-1">Status Perkawinan</label><input required name="status_perkawinan" value="{{ old('status_perkawinan', $w->status_perkawinan ?? '') }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm"></div>
      <div><label class="block text-xs font-semibold text-slate-500 mb-1">Hubungan Keluarga</label><input required name="hubungan_keluarga" value="{{ old('hubungan_keluarga', $w->hubungan_keluarga ?? '') }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm"></div>
      <div class="sm:col-span-2">
        <label class="block text-xs font-semibold text-slate-500 mb-1">Foto KTP</label>
        <input type="file" name="foto_ktp" accept="image/*" class="block w-full text-sm text-slate-500">
        @if(isset($w) && $w->foto_ktp)
          <div class="mt-2"><img src="{{ asset('storage/'.$w->foto_ktp) }}" class="h-20 rounded-lg border border-slate-200"></div>
        @endif
      </div>
    </div>

    <div class="flex justify-end gap-2">
      <button type="button" onclick="closeModal()" class="px-4 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-50 border border-slate-200">Batal</button>
      <button type="submit" class="px-4 py-2 rounded-lg text-sm font-medium bg-primary-600 text-white hover:bg-primary-700 shadow shadow-primary-500/20">Simpan</button>
    </div>
  </form>
</div>
