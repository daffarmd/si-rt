<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun - SI RT</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <script>
    tailwind.config = { theme: { extend: { colors: { primary: { 50:'#eff6ff',100:'#dbeafe',500:'#3b82f6',600:'#2563eb',700:'#1d4ed8' } }, fontFamily: { sans:['Inter','sans-serif'] } } } }
  </script>
  <style>body{font-family:'Inter',sans-serif;} .glass{background:rgba(255,255,255,0.85);backdrop-filter:blur(12px);}</style>
</head>
<body class="bg-slate-50 text-slate-700 antialiased">

  <div class="min-h-screen flex items-center justify-center p-6 bg-gradient-to-br from-primary-50 to-slate-100">
    <div class="w-full max-w-md">
      <div class="bg-white/80 glass rounded-3xl shadow-2xl border border-white/50 p-8 md:p-10 my-6">
        <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-primary-600 text-white mx-auto mb-6 shadow-lg">
          <i class="ph-fill ph-user-plus text-3xl"></i>
        </div>
        <h1 class="text-2xl font-bold text-slate-900 text-center mb-2">Pendaftaran Warga</h1>
        <p class="text-slate-500 text-center mb-8 text-sm">Silakan buat akun untuk mengakses<br>Layanan Mandiri SI RT</p>

        @if($errors->any())
          <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 text-sm rounded-xl">
            {{ $errors->first() }}
          </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
          @csrf
          
          <!-- Input NIK -->
          <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">NIK (Nomor Induk Kependudukan)</label>
            <div class="relative">
              <i class="ph ph-identification-card absolute left-3.5 top-3 text-slate-400 text-lg"></i>
              <input name="nik" type="text" value="{{ old('nik') }}" required maxlength="16"
                     class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:bg-white transition" placeholder="16 digit NIK Anda">
            </div>
          </div>

          <!-- Input Nama Pengguna -->
          <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Pengguna (Username)</label>
            <div class="relative">
              <i class="ph ph-user absolute left-3.5 top-3 text-slate-400 text-lg"></i>
              <input name="username" type="text" value="{{ old('username') }}" required
                     class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:bg-white transition" placeholder="Buat nama pengguna">
            </div>
          </div>

          <!-- Input Kata Sandi -->
          <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Kata Sandi</label>
            <div class="relative">
              <i class="ph ph-lock-key absolute left-3.5 top-3 text-slate-400 text-lg"></i>
              <input name="password" type="password" required
                     class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:bg-white transition" placeholder="Minimal 8 karakter">
            </div>
          </div>

          <!-- Input Konfirmasi Kata Sandi -->
          <div>
            <label class="block text-sm font-medium text-slate-600 mb-1.5">Konfirmasi Kata Sandi</label>
            <div class="relative">
              <i class="ph ph-lock-key-open absolute left-3.5 top-3 text-slate-400 text-lg"></i>
              <input name="password_confirmation" type="password" required
                     class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:bg-white transition" placeholder="Ulangi kata sandi">
            </div>
          </div>

          <!-- Tombol Submit -->
          <button type="submit" class="w-full py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl shadow-lg shadow-primary-500/30 transition transform active:scale-95 mt-4">
            Daftar Sekarang
          </button>

          <!-- Link Kembali ke Login -->
          <div class="text-center text-sm text-slate-500 mt-4">
            Sudah memiliki akun? <a href="{{ route('login') }}" class="text-primary-600 font-semibold hover:underline">Masuk Aplikasi</a>
          </div>
        </form>
        
        <p class="text-center text-xs text-slate-400 mt-6">&copy; SI RT. All rights reserved.</p>
      </div>
    </div>
  </div>
</body>
</html>