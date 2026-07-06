<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'SI RT') - Sistem Informasi RT/RW</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: { primary: { 50: '#eff6ff', 100: '#dbeafe', 500: '#3b82f6', 600: '#2563eb', 700: '#1d4ed8' } },
          fontFamily: { sans: ['Inter','sans-serif'] }
        }
      }
    }
  </script>
  <style>
    body { font-family: 'Inter', sans-serif; }
    .fade-in { animation: fadeIn .25s ease-out; }
    @keyframes fadeIn { from { opacity:0; transform:translateY(8px);} to { opacity:1; transform:translateY(0);} }
    .glass { background: rgba(255,255,255,0.85); backdrop-filter: blur(12px); }
  </style>
  @stack('styles')
</head>
<body class="bg-slate-50 text-slate-700 antialiased">

  <div class="min-h-screen flex">
    @include('partials.sidebar')

    <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/30 z-30 hidden md:hidden"></div>

    <div class="flex-1 flex flex-col min-w-0">
      @include('partials.header')

      <main class="flex-1 p-6 md:p-8 overflow-y-auto fade-in">
        @yield('content')
      </main>
    </div>
  </div>

  {{-- Modal besar (form) --}}
  <div id="modal-overlay" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
    <div id="modal-content" class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto fade-in"></div>
  </div>
  {{-- Modal kecil (detail) --}}
  <div id="modal-sm-overlay" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
    <div id="modal-sm-content" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto fade-in"></div>
  </div>

  <div id="toast-container" class="fixed bottom-6 right-6 z-[60] space-y-2"></div>

  @if(session('success'))
    <script>document.addEventListener('DOMContentLoaded', () => toast(@json(session('success'))));</script>
  @endif

  <script src="{{ asset('js/app.js') }}"></script>
  @stack('scripts')
</body>
</html>
