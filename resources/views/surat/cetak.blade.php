<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat {{ $surat->jenis_surat }}</title>
  <style>
    body{font-family:'Inter',sans-serif; padding:40px; color:#334155;}
    .kop{text-align:center; border-bottom:4px double #64748b; padding-bottom:12px; margin-bottom:24px;}
    h1{margin:8px 0 4px; font-size:22px; letter-spacing:2px}
    h2{margin:0; font-size:16px; font-weight:600}
    p.lead{text-align:center; font-size:14px; margin-top:8px;}
    .isi{margin:24px 0; line-height:1.8;}
    .meta{width:100%; margin-bottom:24px;}
    .meta td{padding:4px 8px; vertical-align:top;}
    .ttd{float:right; text-align:center; margin-top:40px;}
    .btn{position:fixed; top:16px; right:16px; background:#2563eb; color:#fff; border:none; padding:10px 18px; border-radius:8px; cursor:pointer; font-family:inherit; font-weight:600;}
    @media print{.btn{display:none;}}
  </style>
</head>
<body>
  <button class="btn" onclick="window.print()">Cetak / Simpan PDF</button>

  <div class="kop">
    <h1>PEMERINTAH KOTA MALANG</h1>
    <h2>KECAMATAN KROMENGAN - KELURAHAN KROMENGAN</h2>
    <p class="lead">RW {{ $surat->warga->kartuKeluarga->rw ?? '-' }} / RT {{ $surat->warga->kartuKeluarga->rt ?? '-' }}</p>
  </div>

  <h3 style="text-align:center; margin:24px 0 8px;">SURAT {{ strtoupper($surat->jenis_surat) }}</h3>
  <hr style="width:200px; border:1px solid #334155; margin:0 auto 24px;">

  <div class="isi">
    <p>Yang bertanda tangan di bawah ini, Ketua RT, menerangkan bahwa:</p>
    <table class="meta">
      <tbody>
        <tr><td style="width:140px">Nama</td><td>: {{ $surat->warga->nama ?? '-' }}</td></tr>
        <tr><td>NIK</td><td>: {{ $surat->warga->nik ?? '-' }}</td></tr>
        <tr><td>Jenis Kelamin</td><td>: {{ $surat->warga && $surat->warga->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
        <tr><td>Pekerjaan</td><td>: {{ $surat->warga->pekerjaan ?? '-' }}</td></tr>
        <tr><td>Keperluan</td><td>: {{ $surat->keperluan }}</td></tr>
      </tbody>
    </table>
    <p>Demikian surat <strong>{{ $surat->jenis_surat }}</strong> ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
  </div>

  <div class="ttd">
    <p>Malang, {{ now()->translatedFormat('d F Y') }}</p>
    <p style="margin:0 0 60px;">Ketua RT</p>
    <p style="font-weight:700; text-decoration:underline;">Ahmad Junaedi</p>
  </div>
</body>
</html>
