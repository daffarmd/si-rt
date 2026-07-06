@props(['paginator'])
{{-- Cukup pakai paginator bawaan Laravel, sudah otomatis tema Tailwind kalau di publish --}}
<div class="mt-4">
  {{ $paginator->links() }}
</div>
