<?php 

include "../../config/config.php";

extract($_POST);
// $idsupplier = trim(mysqli_real_escape_string($conn, $_POST['idsupplier']));

$query = "INSERT INTO tb_member (nama, alamat, jenis_kelamin, tlp) values ('$nama', '$alamat','$jenisKelamin','$tlp')";
$hasil = mysqli_query($conn,$query);

if (!$hasil) {
    die("QUERY GAGAL DIJALANKAN:".mysqli_errno($conn)."-". mysqli_error($conn));
}else{
    echo
    "<script>alert('data Berhasil Disimpan');
    window.location='../../dashboard.php?page=member';</script>";
}

?>