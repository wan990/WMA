<?php
include 'header.php';
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id     = $_POST['id'];
  $bulan  = $_POST['bulan'];
  $jumlah = $_POST['jumlah'];
  mysqli_query($koneksi, "UPDATE penjualan SET bulan='$bulan', jumlah='$jumlah' WHERE id=$id");
  echo "<script>alert('Data berhasil diupdate'); window.location.href='input.php';</script>";
  exit;
} else {
  $id = $_GET['id'];
  $data = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE id = $id");
  $d = mysqli_fetch_assoc($data);
  ?>
  <h3>Edit Data Penjualan</h3>
  <form action="" method="POST">
    <input type="hidden" name="id" value="<?= $d['id'] ?>">
    <div class="mb-3">
      <label>Bulan</label>
      <input type="text" class="form-control" name="bulan" value="<?= $d['bulan'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Jumlah Penjualan</label>
      <input type="number" class="form-control" name="jumlah" value="<?= $d['jumlah'] ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="input.php" class="btn btn-secondary">Batal</a>
  </form>
<?php }
include 'footer.php'; ?>
