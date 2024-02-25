<?php
include '../../config/config.php';
$idoutlet = $_GET["id_outlet"];



$query = "DELETE FROM tb_outlet WHERE id_outlet='$idoutlet' ";
$hasil_query = mysqli_query($conn, $query);


if (!$hasil_query) {
  die("Gagal menghapus data: " . mysqli_errno($koneksi) .
    " - " . mysqli_error($koneksi));
} else {
  echo "<script>alert('Data Telah Berhasil Dihapus.');window.location='../../dashboard.php?page=outlet';</script>";
}