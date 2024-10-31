<?php
include '../../config/config.php';
$id_user = $_GET["id_user"];


$hapusTransaksi = "DELETE FROM tb_transaksi WHERE id_user = '$id_user'";
$hapusUser = "DELETE FROM tb_user WHERE id_user='$id_user' ";
$hasil_query_transaksi = mysqli_query($conn, $hapusTransaksi);
$hasil_query_user = mysqli_query($conn, $hapusUser);


if (!$hasil_query_user) {
  die("Failed to delete data: " . mysqli_errno($conn) .
    " - " . mysqli_error($conn));
} else {
  echo "<script>alert('Data Berhasil Dihapus');window.location='../../dashboard.php?page=user';</script>";
}
