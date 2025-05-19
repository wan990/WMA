<?php
include 'header.php';
include 'koneksi.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $bulan = trim($_POST['bulan']);
  $jumlah = trim($_POST['penjualan']);

  if ($bulan === '' || $jumlah === '') {
    $message = '<div class="alert alert-danger">Bulan dan jumlah penjualan wajib diisi.</div>';
  } else if (!is_numeric($jumlah) || $jumlah < 0) {
    $message = '<div class="alert alert-danger">Jumlah penjualan harus berupa angka positif.</div>';
  } else {
    $bulan_safe = mysqli_real_escape_string($koneksi, $bulan);
    $jumlah_safe = (int)$jumlah;
    $query = "INSERT INTO penjualan (bulan, jumlah) VALUES ('$bulan_safe', $jumlah_safe)";
    if (mysqli_query($koneksi, $query)) {
      $message = '<div class="alert alert-success">Data berhasil disimpan.</div>';
    } else {
      $message = '<div class="alert alert-danger">Terjadi kesalahan: ' . mysqli_error($koneksi) . '</div>';
    }
  }
}
?>

<h3>Input Data Penjualan</h3>

<?php echo $message; ?>

<form method="POST" class="mb-4">
  <div class="mb-3">
    <label for="bulan" class="form-label">Bulan</label>
    <select class="form-select" id="bulan" name="bulan" required>
      <option value="" selected disabled>Pilih Bulan</option>
      <?php
      $months = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
      ];
      foreach ($months as $m) {
        echo "<option value=\"$m\">$m</option>";
      }
      ?>
    </select>
  </div>
  <div class="mb-3">
    <label for="penjualan" class="form-label">Jumlah Penjualan</label>
    <input type="number" min="0" class="form-control" id="penjualan" name="penjualan" required>
  </div>
  <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<h4>Data Penjualan</h4>
<table class="table table-bordered table-striped align-middle">
  <thead class="table-light">
    <tr>
      <th style="width: 50px;">No</th>
      <th>Bulan</th>
      <th>Penjualan</th>
      <th style="width: 140px;">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $data = mysqli_query($koneksi, "SELECT * FROM penjualan ORDER BY id ASC");
    $no = 1;
    while ($d = mysqli_fetch_assoc($data)) {
      $id = (int)$d['id'];
      $bulan = htmlspecialchars($d['bulan']);
      $jumlah = (int)$d['jumlah'];
      echo "<tr>";
      echo "<td>{$no}</td>";
      echo "<td>{$bulan}</td>";
      echo "<td>{$jumlah}</td>";
      echo "<td>
              <a href='edit.php?id={$id}' class='btn btn-sm btn-warning me-1'>Edit</a>
              <a href='hapus.php?id={$id}' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin hapus data ini?')\">Hapus</a>
            </td>";
      echo "</tr>";
      $no++;
    }
    ?>
  </tbody>
</table>

<?php include 'footer.php'; ?>
