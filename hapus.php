<?php
include 'koneksi.php';
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM penjualan WHERE id = $id");
header("Location: pages/input.php");
?>