<?php

include './config/config.php';
session_start();
if (@$_SESSION['username'] == null) {
    echo "<script>
        alert('Login Terlebih dahulu');
        window.location.href='./login/login.php';
        </script>";
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <title>Laundry Project</title>
    <link rel="stylesheet" href="./assets/css/dashboard.css" />

</head>

<body>

    <div id="overlay" class="overlay"></div>