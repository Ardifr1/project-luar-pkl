<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hasil Pencarian</title>
</head>
<body>
  <h2>Hasil pencarian untuk: {{ $query }}</h2>

  <h3>Guru</h3>
  <ul>
    @forelse($guru as $g)
      <li>{{ $g->name }} ({{ $g->username }})</li>
    @empty
      <li>Tidak ada guru ditemukan</li>
    @endforelse
  </ul>

  <h3>Lab</h3>
  <ul>
    @forelse($lab as $l)
      <li>{{ $l->nama_lab }}</li>
    @empty
      <li>Tidak ada lab ditemukan</li>
    @endforelse
  </ul>

  <h3>Mapel</h3>
  <ul>
    @forelse($mapel as $m)
      <li>{{ $m->nama_pelajaran }}</li>
    @empty
      <li>Tidak ada mapel ditemukan</li>
    @endforelse
  </ul>

  <h3>Peminjaman</h3>
  <ul>
    @forelse($peminjaman as $p)
      <li>{{ $p->lab->nama_lab }} - {{ $p->tanggal }} ({{ $p->user->name }})</li>
    @empty
      <li>Tidak ada peminjaman ditemukan</li>
    @endforelse
  </ul>
</body>
</html>
