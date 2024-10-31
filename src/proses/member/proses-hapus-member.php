<?php
include '../../config/config.php';
$idmember = $_GET["id_member"];



$query = "DELETE FROM tb_member WHERE id_member='$idmember' ";
$hasil_query = mysqli_query($conn, $query);


if (!$hasil_query) {
  die("Gagal menghapus data: " . mysqli_errno($koneksi) .
    " - " . mysqli_error($koneksi));
} else {
  echo "<script>alert('Data Telah Berhasil Dihapus.');window.location='../../dashboard.php?page=member';</script>";
}