<div class="p-6">
  <div class="flex items-center justify-between mb-4">
    <h3 class="font-bold text-lg text-slate-800">Detail Kartu Keluarga</h3>
    <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600"><i class="ph ph-x text-2xl"></i></button>
  </div>
  <div class="space-y-3 text-sm">
    <div class="grid grid-cols-2 gap-4 bg-slate-50 p-3 rounded-lg"><span class="text-slate-500">No. KK</span><span class="font-semibold text-slate-800">{{ $k->no_kk }}</span></div>
    <div class="grid grid-cols-2 gap-4 bg-slate-50 p-3 rounded-lg"><span class="text-slate-500">Kepala Keluarga</span><span class="font-semibold text-slate-800">{{ $k->kepala_keluarga }}</span></div>
    <div class="grid grid-cols-2 gap-4 bg-slate-50 p-3 rounded-lg"><span class="text-slate-500">Alamat</span><span class="font-semibold text-slate-800">{{ $k->alamat }}</span></div>
    <div class="grid grid-cols-2 gap-4 bg-slate-50 p-3 rounded-lg"><span class="text-slate-500">RT / RW</span><span class="font-semibold text-slate-800">{{ $k->rt }} / {{ $k->rw }}</span></div>
  </div>
  <div class="mt-5">
    <h4 class="font-bold text-sm text-slate-700 mb-2">Anggota Keluarga</h4>
    <div class="space-y-2">
      @foreach($k->anggota as $a)
        <div class="flex items-center justify-between p-2 border border-slate-100 rounded-lg">
          <span class="text-sm text-slate-700">{{ $a->nama }}</span>
          <span class="text-xs text-slate-500">{{ $a->hubungan_keluarga }}</span>
        </div>
      @endforeach
    </div>
  </div>
</div>
