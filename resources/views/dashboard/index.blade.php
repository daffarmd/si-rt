@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    @foreach($stats as $s)
      <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between mb-3">
          <div class="w-10 h-10 rounded-xl {{ $s['clr'] }} flex items-center justify-center">
            <i class="ph-fill {{ $s['icon'] }} text-xl"></i>
          </div>
        </div>
        <h3 class="text-2xl font-bold text-slate-800">{{ $s['value'] }}</h3>
        <p class="text-sm text-slate-500 mt-1">{{ $s['label'] }}</p>
      </div>
    @endforeach
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
      <div class="flex items-center justify-between mb-4">
        <h3 class="font-bold text-slate-800">Surat Terbaru</h3>
        <a href="{{ route('surat.index') }}" class="text-xs font-semibold text-primary-600 hover:underline">Lihat Semua</a>
      </div>
      <div class="space-y-3">
        @foreach($lastSurat as $s)
          <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-100">
            <div class="flex items-center gap-3">
              <div class="w-9 h-9 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-xs font-bold">
                {{ substr($s->warga->nama ?? '-', 0, 1) }}
              </div>
              <div>
                <p class="text-sm font-semibold text-slate-800">{{ $s->warga->nama ?? '-' }}</p>
                <p class="text-xs text-slate-500">{{ $s->jenis_surat }}</p>
              </div>
            </div>
            <x-badge-status :status="$s->status" />
          </div>
        @endforeach
      </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
      <div class="flex items-center justify-between mb-4">
        <h3 class="font-bold text-slate-800">Iuran Terbaru</h3>
        <a href="{{ route('iuran.index') }}" class="text-xs font-semibold text-primary-600 hover:underline">Lihat Semua</a>
      </div>
      <div class="space-y-3">
        @foreach($lastIuran as $i)
          <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-100">
            <div class="flex items-center gap-3">
              <div class="w-9 h-9 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-xs font-bold">
                {{ substr($i->warga->nama ?? '-', 0, 1) }}
              </div>
              <div>
                <p class="text-sm font-semibold text-slate-800">{{ $i->warga->nama ?? '-' }}</p>
                <p class="text-xs text-slate-500">{{ $i->bulan }} {{ $i->tahun }}</p>
              </div>
            </div>
            <div class="text-right">
              <x-badge-status :status="$i->status_bayar" />
              <p class="text-xs font-semibold text-slate-700 mt-1">Rp {{ number_format($i->jumlah, 0, ',', '.') }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
