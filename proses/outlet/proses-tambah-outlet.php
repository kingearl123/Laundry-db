<?php 

include "../../config/config.php";

extract($_POST);

$query = "INSERT INTO tb_outlet (id_outlet, nama, alamat, tlp) values ('$id_outlet','$nama', '$alamat','$tlp')";
$hasil = mysqli_query($conn,$query);

if (!$hasil) {
    die("QUERY GAGAL DIJALANKAN:".mysqli_errno($conn)."-". mysqli_error($conn));
}else{
    echo"<script>alert('data Berhasil Disimpan');
    window.location='../../dashboard.php?page=outlet';</script>";
}

?>