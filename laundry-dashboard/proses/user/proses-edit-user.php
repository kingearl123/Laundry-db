<?php
include "../../config/config.php";

extract($_POST);
$id_user = trim(mysqli_real_escape_string($conn, $_POST['id_user']));

    $updatedata = "UPDATE tb_user SET nama='$nama',username='$username',password='$password',id_outlet='$id_outlet',role='$role' WHERE id_user='$id_user'";
    $queryupdate = mysqli_query($conn, $updatedata);

    if ($queryupdate) {
        echo "<script>
        alert('Data berhasil di edit');
        window.location='../../dashboard.php?page=user';
        </script>";
    } else {
        echo "Gagal mengedit data user: " . mysqli_error($conn);
    }

?>