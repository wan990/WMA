<?php include 'header.php'; ?>

<div class="text-center mb-5">
  <h2 class="fw-bold"><i class="bi bi-bar-chart-steps"></i> Selamat Datang di Sistem Peramalan Penjualan</h2>
  <p class="lead">Gunakan sistem ini untuk mencatat data penjualan dan memprediksi penjualan berikutnya menggunakan metode <strong>Weighted Moving Average (WMA)</strong>.</p>
</div>

<div class="row text-center justify-content-center">
  <div class="col-md-4 mb-4">
    <div class="card shadow-sm border-0 h-100">
      <div class="card-body">
        <i class="bi bi-pencil-square display-4 text-primary"></i>
        <h5 class="card-title mt-3">Input Data</h5>
        <p class="card-text">Masukkan data penjualan bulanan sebagai dasar peramalan.</p>
        <a href="input.php" class="btn btn-primary">Mulai Input</a>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-4">
    <div class="card shadow-sm border-0 h-100">
      <div class="card-body">
        <i class="bi bi-calculator display-4 text-warning"></i>
        <h5 class="card-title mt-3">Hitung Peramalan</h5>
        <p class="card-text">Lakukan perhitungan peramalan berdasarkan data penjualan yang sudah ada.</p>
        <a href="hitung.php" class="btn btn-warning text-white">Hitung Sekarang</a>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-4">
    <div class="card shadow-sm border-0 h-100">
      <div class="card-body">
        <i class="bi bi-graph-up display-4 text-success"></i>
        <h5 class="card-title mt-3">Hasil Peramalan</h5>
        <p class="card-text">Lihat hasil perhitungan dan grafik dari metode WMA.</p>
        <a href="hasil.php" class="btn btn-success">Lihat Hasil</a>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
