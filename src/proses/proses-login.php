<?php
include "../config/config.php";
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

$query_login = mysqli_query($conn, "SELECT * FROM tb_user WHERE username= '$username'");
$data_user = mysqli_fetch_assoc($query_login);

// Periksa apakah ada data pengguna yang ditemukan
if ($data_user !== null) {
    $cek = password_verify($password, $data_user['password']);

    if ($cek) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $data_user['role'];
        $_SESSION['idOutlet'] = $data_user['id_outlet'];
        $_SESSION['idUser'] = $data_user['id_user'];

        echo "<script>alert('berhasil Login');
        window.location.href='../dashboard.php?page=homepage'
        </script>";
    } else {
        echo "<script>alert('gagal Login'); window.location.href='../login/login.php'</script>";
    }
} else {
    echo "<script>alert('gagal Login'); window.location.href='../login/login.php'</script>";
    // window.location.href='../login/login.php'
}
?>