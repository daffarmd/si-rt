@extends('layouts.app')

@section('title', 'Manajemen Surat')

@section('content')
<div class="space-y-4">
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
    <form method="GET" action="{{ route('surat.index') }}" class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
      <div class="relative w-full sm:w-72">
        <i class="ph ph-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-lg"></i>
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari surat..."
               class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm">
      </div>
      <select name="status" onchange="this.form.submit()" class="px-3 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
        <option value="">Semua Status</option>
        <option value="diajukan" {{ request('status') === 'diajukan' ? 'selected' : '' }}>Diajukan</option>
        <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
        <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
      </select>
    </form>

    @if(auth()->user()->role === 'admin')
      <button onclick="openModalRemote('{{ route('surat.create') }}')" class="px-4 py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-xl shadow shadow-primary-500/20 flex items-center gap-2">
        <i class="ph ph-plus"></i> Tambah
      </button>
    @endif
  </div>

  @include('surat.partials.table', ['surat' => $surat])

  <x-pagination :paginator="$surat" />
</div>
@endsection
