<?php
// koneksi.php
$koneksi = mysqli_connect("localhost", "root", "", "wma");
if (!$koneksi) {
  die("Koneksi gagal: " . mysqli_connect_error());
}
?>
