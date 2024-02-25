<?php
include "../../config/config.php";

$id_transaksi = $_POST['id_transaksi'];
$status = $_POST['status'];
@$page = $_POST['page'];

    $updatedata = "UPDATE tb_transaksi SET status='$status' WHERE id_transaksi='$id_transaksi'";
    $queryupdate = mysqli_query($conn, $updatedata);

if(@$page == "laporan"){
    if ($queryupdate) {
        echo "<script>window.location='../../dashboard.php?page=laporan';</script>";
    } else {
        echo "Gagal mengedit data user: " . mysqli_error($conn);
    }
}else{
    if ($queryupdate) {
        echo "<script>window.location='../../dashboard.php?page=detail-transaksi&id_transaksi=$id_transaksi';</script>";
    } else {
        echo "Gagal mengedit data user: " . mysqli_error($conn);
    }
}
?>