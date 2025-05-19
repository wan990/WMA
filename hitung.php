<?php
include 'header.php';
include 'koneksi.php';

$data_penjualan = mysqli_query($koneksi, "SELECT * FROM penjualan ORDER BY id ASC");
$penjualan = [];
while ($row = mysqli_fetch_assoc($data_penjualan)) {
  $penjualan[] = $row;
}

$selected_bulan = $_POST['bulan_dipilih'] ?? null;
$index_terpilih = -1;
$can_calculate = false;
$show_result = false;

if ($selected_bulan) {
  foreach ($penjualan as $i => $item) {
    if ($item['bulan'] === $selected_bulan) {
      $index_terpilih = $i;
      break;
    }
  }

  if ($index_terpilih >= 3) {
    $can_calculate = true;

    if (isset($_POST['hitung'])) {
      $wma = (
        $penjualan[$index_terpilih - 3]['jumlah'] * 1 +
        $penjualan[$index_terpilih - 2]['jumlah'] * 2 +
        $penjualan[$index_terpilih - 1]['jumlah'] * 3
      ) / 6;

      $id = $penjualan[$index_terpilih]['id'];
      $stmt = mysqli_prepare($koneksi, "UPDATE penjualan SET hasil = ? WHERE id = ?");
      mysqli_stmt_bind_param($stmt, "di", $wma, $id);
      mysqli_stmt_execute($stmt);

      $show_result = true; 
    }
  }
}
?>

<h3 class="mb-4"><i class="bi bi-calculator"></i> Hitung Peramalan Penjualan</h3>

<form method="POST" class="mb-4">
  <div class="row g-3 align-items-end">
    <div class="col-md-6">
      <label for="bulan_dipilih" class="form-label">Pilih Bulan</label>
      <select name="bulan_dipilih" id="bulan_dipilih" class="form-select" required onchange="this.form.submit()">
        <option value="">-- Pilih Bulan --</option>
        <?php foreach ($penjualan as $item): ?>
          <option value="<?= $item['bulan'] ?>" <?= ($item['bulan'] == $selected_bulan) ? 'selected' : '' ?>>
            <?= $item['bulan'] ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
</form>

<!-- Tabel Data Sebelumnya -->
<?php if ($selected_bulan): ?>
  <h5 class="mt-4">Data Sebelumnya untuk Peramalan Bulan: <strong><?= htmlspecialchars($selected_bulan) ?></strong></h5>

  <?php if ($can_calculate): ?>
    <?php if (!$show_result): ?>
      <div class="alert alert-info">Klik tombol <strong>Hitung</strong> untuk melihat hasil peramalan.</div>
      <form method="POST">
        <input type="hidden" name="bulan_dipilih" value="<?= htmlspecialchars($selected_bulan) ?>">
        <button type="submit" name="hitung" class="btn btn-success"><i class="bi bi-check-circle"></i> Hitung </button>
      </form>
    <?php endif; ?>

    <?php if ($show_result): ?>
      <table class="table table-bordered mt-3">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Bulan</th>
            <th>Penjualan</th>
            <th>Bobot</th>
            <th>Hasil Perkalian</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $weights = [1, 2, 3];
          $total = 0;
          for ($i = 0; $i < 3; $i++) {
            $idx = $index_terpilih - 3 + $i;
            $jumlah = $penjualan[$idx]['jumlah'];
            $bobot = $weights[$i];
            $perkalian = $jumlah * $bobot;
            $total += $perkalian;
            echo "<tr>
                    <td>" . ($i + 1) . "</td>
                    <td>{$penjualan[$idx]['bulan']}</td>
                    <td>{$jumlah}</td>
                    <td>{$bobot}</td>
                    <td>{$perkalian}</td>
                  </tr>";
          }
          $wma = round($total / 6, 2);
          ?>
          <tr class="table-secondary">
            <td colspan="4"><strong>Hasil Peramalan</strong></td>
            <td><strong><?= $wma ?></strong></td>
          </tr>
        </tbody>
      </table>

      <div class="alert alert-success mt-3">
        Peramalan bulan <strong><?= htmlspecialchars($selected_bulan) ?></strong> berhasil dihitung
      </div>
    <?php endif; ?>
    
<?php if ($show_result): ?>
  <div class="mt-3 mb-5">
    <a href="hasil.php" class="btn btn-primary">
      <i class="bi bi-bar-chart-line-fill"></i> Lihat Semua Hasil Peramalan
    </a>
  </div>
<?php endif; ?>

  <?php else: ?>
    <div class="alert alert-warning mt-3">
      Data tidak cukup untuk menghitung peramalan bulan <strong><?= htmlspecialchars($selected_bulan) ?></strong>.<br>
      Minimal harus ada 3 bulan sebelumnya.
    </div>
  <?php endif; ?>
<?php endif; ?>

<?php include 'footer.php'; ?>
