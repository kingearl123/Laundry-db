<?php 

include "../../config/config.php";

extract($_POST);

$query = "INSERT INTO tb_paket (id_outlet, jenis, nama_paket, harga) values ('$id_outlet','$jenis', '$nama','$harga')";
$hasil = mysqli_query($conn,$query);

if (!$hasil) {
    die("QUERY GAGAL DIJALANKAN:".mysqli_errno($conn)."-". mysqli_error($conn));
}else{
    echo"<script>alert('data Berhasil Disimpan');
    window.location='../../dashboard.php?page=paket';
    </script>";
}

?>