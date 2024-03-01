<?php
include "../config/config.php";

$namalengkap    = $_POST['nama'];
$username       = $_POST['username'];
$password       = $_POST['password'];
$password_hash  = password_hash($password,PASSWORD_DEFAULT);
$idkaryawan     = $_POST['id_outlet'];
$level          = $_POST['role'];

$query_username = mysqli_query($conn, "SELECT username FROM tb_user WHERE username='$username'");

$cek = mysqli_num_rows($query_username);

if($cek != 0){
    echo "
        <script>
            alert('username sudah ada, silahkan masukkan username yang lain');
            window.location.href='../register/register.php';
        </script>
    ";
}else{
    $hasil = mysqli_query($conn,"INSERT INTO tb_user VALUES(NULL,'$namalengkap','$username','$password_hash','$idkaryawan','$level')");
    
    if(!$hasil){
        echo "Gagal Register" . mysqli_error($conn);
    }else{
        header('Location:../login/login.php');
        exit;
    } 
}





?>