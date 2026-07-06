@props(['status'])
@php
  $map = [
    'diajukan'    => 'bg-amber-100 text-amber-700 border-amber-200',
    'diproses'    => 'bg-sky-100 text-sky-700 border-sky-200',
    'selesai'     => 'bg-emerald-100 text-emerald-700 border-emerald-200',
    'lunas'       => 'bg-emerald-100 text-emerald-700 border-emerald-200',
    'belum_lunas' => 'bg-rose-100 text-rose-700 border-rose-200',
  ];
  $cls = $map[$status] ?? 'bg-slate-100 text-slate-600 border-slate-200';
@endphp
<span class="px-2.5 py-1 rounded-lg text-xs font-semibold border {{ $cls }} capitalize">
  {{ str_replace('_', ' ', $status) }}
</span>
