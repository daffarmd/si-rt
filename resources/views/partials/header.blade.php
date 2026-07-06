<header class="h-16 bg-white/80 glass border-b border-slate-200 sticky top-0 z-20 px-6 flex items-center justify-between">
  <div class="flex items-center gap-4">
    <button onclick="toggleSidebar()" class="md:hidden p-2 rounded-lg hover:bg-slate-100 text-slate-600">
      <i class="ph ph-list text-xl"></i>
    </button>
    <h1 class="text-lg font-bold text-slate-800">@yield('title', 'Dashboard')</h1>
  </div>
  <div class="flex items-center gap-4">
    <div class="text-right hidden sm:block">
      <p class="text-sm font-semibold text-slate-800 leading-tight">{{ auth()->user()->name ?? 'Admin' }}</p>
      <p class="text-xs text-slate-500">{{ auth()->user()->role === 'admin' ? 'Admin RT / RW' : 'Warga' ?? 'Administrator' }}</p>
    </div>
    <div class="w-10 h-10 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-sm border border-primary-200">
      {{ strtoupper(substr(auth()->user()->name ?? 'AD', 0, 2)) }}
    </div>
  </div>
</header>
