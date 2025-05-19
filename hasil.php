<?php
include 'header.php';
include 'koneksi.php';

// Ambil hanya data dengan hasil_wma yang tidak null
$data = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE hasil IS NOT NULL ORDER BY id ASC");

$hasil = [];
while ($row = mysqli_fetch_assoc($data)) {
  $hasil[] = $row;
}
?>

<h3 class="mb-4"><i class="bi bi-bar-chart-line-fill"></i> Hasil Peramalan Penjualan</h3>

<?php if (count($hasil) === 0): ?>
  <div class="alert alert-warning">Belum ada data yang dihitung. Silakan lakukan perhitungan di halaman <a href="hitung.php">Hitung</a>.</div>
<?php else: ?>
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="table-light">
        <tr>
          <th>No</th>
          <th>Bulan</th>
          <th>Jumlah Penjualan</th>
          <th>Hasil Peramalan (WMA)</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($hasil as $d) {
          echo "<tr>";
          echo "<td>$no</td>";
          echo "<td>" . htmlspecialchars($d['bulan']) . "</td>";
          echo "<td>" . number_format($d['jumlah']) . "</td>";
          echo "<td>" . number_format($d['hasil'], 2) . "</td>";
          echo "</tr>";
          $no++;
        }
        ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>

<?php include 'footer.php'; ?>
