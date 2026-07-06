@extends('layouts.app')

@section('title', 'Iuran Warga')

@section('content')
<div class="space-y-4">
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
    <form method="GET" action="{{ route('iuran.index') }}" class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
      <div class="relative w-full sm:w-72">
        <i class="ph ph-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-lg"></i>
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari iuran..."
               class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm">
      </div>
      <select name="status" onchange="this.form.submit()" class="px-3 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
        <option value="">Semua Status</option>
        <option value="lunas" {{ request('status') === 'lunas' ? 'selected' : '' }}>Lunas</option>
        <option value="belum_lunas" {{ request('status') === 'belum_lunas' ? 'selected' : '' }}>Belum Lunas</option>
      </select>
    </form>

    <div class="flex gap-2">
      <a href="{{ route('iuran.export') }}" class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-xl shadow shadow-emerald-500/20 flex items-center gap-2">
        <i class="ph ph-microsoft-excel-logo"></i> Export Excel
      </a>
      @if(auth()->user()->role === 'admin')
        <button onclick="openModalRemote('{{ route('iuran.create') }}')" class="px-4 py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-xl shadow shadow-primary-500/20 flex items-center gap-2">
          <i class="ph ph-plus"></i> Tambah
        </button>
      @endif
    </div>
  </div>

  @include('iuran.partials.table', ['iuran' => $iuran])

  <x-pagination :paginator="$iuran" />
</div>
@endsection
