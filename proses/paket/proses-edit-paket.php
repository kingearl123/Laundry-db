<?php
include "../../config/config.php";

extract($_POST);
$id_paket = trim(mysqli_real_escape_string($conn, $_POST['id_paket']));

    $updatedata = "UPDATE tb_paket SET nama_paket='$nama',jenis='$jenis',harga='$harga',id_outlet='$id_outlet' WHERE id_paket='$id_paket'";
    $queryupdate = mysqli_query($conn, $updatedata);

    if ($queryupdate) {
        echo "<script>
        alert('Data berhasil di edit');
        window.location='../../view/dashboard.php?page=paket';
        </script>";
    } else {
        echo "Gagal mengedit data outlet: " . mysqli_error($conn);
    }

?>