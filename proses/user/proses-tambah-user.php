<?php

include "../../config/config.php";

extract($_POST);
// $idsupplier = trim(mysqli_real_escape_string($conn, $_POST['idsupplier']));
$hashPass = password_hash($password, PASSWORD_DEFAULT);


$query = "INSERT INTO tb_user (nama, username, password, id_outlet, role) values ('$nama','$username', '$hashPass','$id_outlet','$role')";
$hasil = mysqli_query($conn, $query);

if (!$hasil) {
    die("QUERY FAILED TO EXECUTE:" . mysqli_errno($conn) . "-" . mysqli_error($conn));
} else {
    echo "<script>alert('Data Saved Successfully');window.location='../../dashboard.php?page=user';</script>";
}
