<?php
include "../../config/config.php";

extract($_POST);
$id_outlet = trim(mysqli_real_escape_string($conn, $_POST['id_outlet']));

$namaOutlet = trim(mysqli_real_escape_string($conn, $_POST['nama']));  // Updated field name
$alamatOutlet = trim(mysqli_real_escape_string($conn, $_POST['alamat']));  // Updated field name
$telpOutlet = trim(mysqli_real_escape_string($conn, $_POST['tlp']));  // Updated field name

$updatedata = "UPDATE tb_outlet SET nama='$namaOutlet', alamat='$alamatOutlet', tlp='$telpOutlet' WHERE id_outlet='$id_outlet'";
$queryupdate = mysqli_query($conn, $updatedata);

if ($queryupdate) {
    echo "<script>
        alert('Data berhasil di edit');
        window.location='../../dashboard.php?page=outlet';
        </script>";
} else {
    echo "Gagal mengedit data outlet: " . mysqli_error($conn);
}
?>
