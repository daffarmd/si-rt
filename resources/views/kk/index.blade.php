@extends('layouts.app')

@section('title', 'Kartu Keluarga')

@section('content')
<div class="space-y-4">
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
    <form method="GET" action="{{ route('kk.index') }}" class="relative w-full sm:w-80">
      <i class="ph ph-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-lg"></i>
      <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari no KK atau nama..."
             class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm">
    </form>

    @if(auth()->user()->role === 'admin')
      <button onclick="openModalRemote('{{ route('kk.create') }}')"
              class="px-4 py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-xl shadow shadow-primary-500/20 flex items-center gap-2">
        <i class="ph ph-plus"></i> Tambah KK
      </button>
    @endif
  </div>

  @include('kk.partials.table', ['kk' => $kk])

  <x-pagination :paginator="$kk" />
</div>
@endsection
