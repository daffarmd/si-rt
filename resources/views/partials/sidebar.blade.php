<aside id="sidebar" class="fixed md:sticky top-0 left-0 z-40 h-screen w-64 bg-white border-r border-slate-200 transform -translate-x-full md:translate-x-0 transition-transform duration-300">
  <div class="h-16 flex items-center px-6 border-b border-slate-100">
    <div class="flex items-center gap-3">
      <div class="w-9 h-9 rounded-xl bg-primary-600 text-white flex items-center justify-center">
        <i class="ph-fill ph-buildings text-xl"></i>
      </div>
      <div>
        <h2 class="font-bold text-slate-800 leading-tight text-sm">SI RT</h2>
        <p class="text-[10px] text-slate-400 font-medium uppercase tracking-wider">Sistem Informasi</p>
      </div>
    </div>
  </div>

  <nav class="p-4 space-y-1">
    @php
      $menus = [
        ['route' => 'dashboard.index', 'icon' => 'ph-squares-four', 'label' => 'Dashboard'],
        ['route' => 'kk.index',        'icon' => 'ph-identification-card', 'label' => 'Kartu Keluarga'],
        ['route' => 'warga.index',     'icon' => 'ph-users', 'label' => 'Data Warga'],
        ['route' => 'surat.index',     'icon' => 'ph-envelope-simple', 'label' => 'Manajemen Surat'],
        ['route' => 'iuran.index',     'icon' => 'ph-coins', 'label' => 'Iuran Warga'],
      ];
    @endphp

    @foreach($menus as $menu)
      <a href="{{ route($menu['route']) }}"
         class="nav-item w-full flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition hover:bg-slate-50
                {{ request()->routeIs(explode('.', $menu['route'])[0].'.*') ? 'bg-primary-50 text-primary-700' : 'text-slate-600' }}">
        <i class="ph {{ $menu['icon'] }} text-lg"></i> {{ $menu['label'] }}
      </a>
    @endforeach

    <div class="pt-4 mt-4 border-t border-slate-100">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition hover:bg-red-50 text-red-600">
          <i class="ph ph-sign-out text-lg"></i> Keluar
        </button>
      </form>
    </div>
  </nav>

  <button onclick="toggleSidebar()" class="md:hidden absolute top-4 right-4 text-slate-400 hover:text-slate-600">
    <i class="ph ph-x text-2xl"></i>
  </button>
</aside>
