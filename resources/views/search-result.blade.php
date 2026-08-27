<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hasil Pencarian</title>
  <style>
    body { background:#222; font-family:Arial,sans-serif; }
    .phone {
      max-width:412px; min-height:917px;
      margin:20px auto; background:#fff; padding:20px;
    }
    h2 { text-align:center; margin-bottom:20px; }
    .result-box {
      background:#D9D9D9;
      border-radius:10px;
      padding:15px;
      margin-bottom:20px;
    }
    .result-box h3 {
      margin-bottom:10px;
      color:#102C6B;
    }
    .result-box ul {
      list-style:none; padding:0;
    }
    .result-box li {
      background:#f1f5f9;
      margin-bottom:8px;
      padding:8px;
      border-radius:6px;
    }
  </style>
</head>
<body>
  <div class="phone">
    <h2>Hasil pencarian untuk: "{{ $query }}"</h2>

    <div class="result-box">
      <h3>Guru</h3>
      <ul>
        @forelse($guru as $g)
          <li>{{ $g->name }} ({{ $g->username }})</li>
        @empty
          <li>Tidak ada guru ditemukan</li>
        @endforelse
      </ul>
    </div>

    <div class="result-box">
      <h3>Lab</h3>
      <ul>
        @forelse($lab as $l)
          <li>{{ $l->nama_lab }}</li>
        @empty
          <li>Tidak ada lab ditemukan</li>
        @endforelse
      </ul>
    </div>

    <div class="result-box">
      <h3>Mapel</h3>
      <ul>
        @forelse($mapel as $m)
          <li>{{ $m->nama_pelajaran }}</li>
        @empty
          <li>Tidak ada mapel ditemukan</li>
        @endforelse
      </ul>
    </div>

    <div class="result-box">
      <h3>Peminjaman</h3>
      <ul>
        @forelse($peminjaman as $p)
          <li>{{ $p->lab->nama_lab }} - {{ $p->tanggal }} ({{ $p->user->name }})</li>
        @empty
          <li>Tidak ada peminjaman ditemukan</li>
        @endforelse
      </ul>
    </div>
  </div>
</body>
</html>
