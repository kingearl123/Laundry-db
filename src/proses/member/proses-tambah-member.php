<?php 

include "../../config/config.php";

extract($_POST);

// Check if data already exists
$check_query = "SELECT * FROM tb_member WHERE nama = '$nama' AND alamat = '$alamat' AND jenis_kelamin = '$jenisKelamin' AND tlp = '$tlp'";
$check_result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    // Data already exists, show notification
    echo "<script>alert('Data yang dimasukkan sudah ada');</script>";
    // Redirect back to the page
    echo "<script>window.location='../../dashboard.php?page=member';</script>";
} else {
    // Data doesn't exist, proceed with insertion
    $query = "INSERT INTO tb_member (nama, alamat, jenis_kelamin, tlp) values ('$nama', '$alamat','$jenisKelamin','$tlp')";
    $hasil = mysqli_query($conn, $query);

    if (!$hasil) {
        die("QUERY GAGAL DIJALANKAN:" . mysqli_errno($conn) . "-" . mysqli_error($conn));
    } else {
        echo "<script>alert('Data Berhasil Disimpan');
        window.location='../../dashboard.php?page=member';</script>";
    }
}

?>