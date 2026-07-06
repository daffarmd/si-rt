<div class="p-6">
  <div class="flex justify-between mb-4">
    <h3 class="font-bold text-lg text-slate-800">Detail Warga</h3>
    <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600"><i class="ph ph-x text-2xl"></i></button>
  </div>
  <div class="flex gap-4 mb-4">
    <div class="w-20 h-20 rounded-2xl bg-slate-200 text-slate-600 flex items-center justify-center text-2xl font-bold overflow-hidden">
      @if($w->foto_ktp)
        <img src="{{ asset('storage/'.$w->foto_ktp) }}" class="w-full h-full object-cover">
      @else
        {{ substr($w->nama, 0, 1) }}
      @endif
    </div>
    <div>
      <p class="font-bold text-slate-800 text-lg">{{ $w->nama }}</p>
      <p class="text-sm text-slate-500">{{ $w->nik }}</p>
      <p class="text-xs text-slate-400 mt-1">{{ $w->hubungan_keluarga }}</p>
    </div>
  </div>
  <div class="grid grid-cols-2 gap-3 text-sm">
    @foreach(['tempat_lahir','tanggal_lahir','jenis_kelamin','agama','pekerjaan','status_perkawinan'] as $field)
      <div class="bg-slate-50 border border-slate-100 p-3 rounded-xl">
        <p class="text-xs text-slate-500 capitalize mb-0.5">{{ str_replace('_',' ', $field) }}</p>
        <p class="font-semibold text-slate-800">{{ $w->{$field} }}</p>
      </div>
    @endforeach
  </div>
</div>
