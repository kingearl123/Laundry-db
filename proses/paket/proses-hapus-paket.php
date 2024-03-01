<?php
include '../../config/config.php';
$id_paket = $_GET["id_paket"];



$query = "DELETE FROM tb_paket WHERE id_paket='$id_paket' ";
$hasil_query = mysqli_query($conn, $query);


if (!$hasil_query) {
  die("Gagal menghapus data: " . mysqli_errno($koneksi) .
    " - " . mysqli_error($koneksi));
} else {
  echo "<script>alert('Data Telah Berhasil Dihapus.');window.location='../../dashboard.php?page=paket';</script>";
}
