<?php
include "../../config/config.php";

extract($_POST);
$id_member = trim(mysqli_real_escape_string($conn, $_POST['id_member']));

    $updatedata = "UPDATE tb_member SET nama='$namaMember',alamat='$alamatMember',jenis_kelamin='$jenisKelaminMember',tlp='$telpMember' WHERE id_member='$id_member'";
    $queryupdate = mysqli_query($conn, $updatedata);

    if ($queryupdate) {
        echo "<script>
        alert('Data berhasil di edit');
        window.location='../../dashboard.php?page=member';
        </script>";
    } else {
        echo "Gagal mengedit data outlet: " . mysqli_error($conn);
    }

?>