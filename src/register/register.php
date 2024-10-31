<?php
include "../config/config.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Register Form </title>
    <style>
        /* Google Fonts - Poppins */

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #4070f4;
            column-gap: 30px;
        }

        .form {
            position: absolute;
            max-width: 430px;
            width: 100%;
            padding: 30px;
            border-radius: 6px;
            background: #FFF;
        }

        .form.signup {
            opacity: 0;
            pointer-events: none;
        }

        .forms.show-signup .form.signup {
            opacity: 1;
            pointer-events: auto;
        }

        .forms.show-signup .form.login {
            opacity: 0;
            pointer-events: none;
        }

        header {
            font-size: 28px;
            font-weight: 600;
            color: #232836;
            text-align: center;
        }

        form {
            margin-top: 30px;
        }

        .form .field {
            position: relative;
            height: 50px;
            width: 100%;
            margin-top: 20px;
            border-radius: 6px;
        }

        select {
            outline: none;
            padding: 0 14px;
            border: 1px solid#CACACA;
        }

        .field input,
        .field button {
            height: 100%;
            width: 100%;
            border: none;
            font-size: 16px;
            font-weight: 400;
            border-radius: 6px;
        }

        .field input {
            outline: none;
            padding: 0 15px;
            border: 1px solid#CACACA;
        }

        .field input:focus {
            border-bottom-width: 2px;
        }

        .field button {
            color: #fff;
            background-color: #0171d3;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .field button:hover {
            background-color: #016dcb;
        }

        .form-link {
            text-align: center;
            margin-top: 10px;
        }

        .form-link span,
        .form-link a {
            font-size: 14px;
            font-weight: 400;
            color: #232836;
        }

        .form a {
            color: #0171d3;
            text-decoration: none;
        }

        .form-content a:hover {
            text-decoration: underline;
        }

        .line {
            position: relative;
            height: 1px;
            width: 100%;
            margin: 36px 0;
            background-color: #d4d4d4;
        }

        .line::before {
            content: 'Or';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #FFF;
            color: #8b8b8b;
            padding: 0 15px;
        }




        @media screen and (max-width: 400px) {
            .form {
                padding: 20px 10px;
            }
        }
    </style>

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <section class="container forms">
        <div class="form login">
            <div class="form-content">
                <header>Register</header>
                <form action="../proses/proses-register.php" method="post">
                    <div class="field input-field">
                        <input type="text" name="nama" placeholder="Masukan Nama Lengkap" required class="input">
                    </div>
                    <div class="field input-field">
                        <input type="text" name="username" placeholder="Masukan Username" required class="input">
                    </div>

                    <div class="field input-field">
                        <input type="password" name="password" required placeholder="Password" class="password">
                    </div>

                    <select class="field input-field" name="id_outlet" required>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM tb_outlet");
                        while ($hasil = mysqli_fetch_assoc($query)) {
                        ?>
                            <option value="<?= $hasil['id_outlet']; ?>"><?= $hasil['nama']; ?></option>
                        <?php
                        }
                        ?>
                    </select>

                    <select class="field input-field" required name="role" id="">
                        <option value="owner">owner</option>
                        <option value="admin">admin</option>
                        <option value="kasir">kasir</option>
                    </select>
                    <div class="field button-field">
                        <input type="submit" style="background: #4070f4; color:#FFF;" value="Register"></input>
                    </div>
                </form>

                <div class="form-link">
                    <span>have an account? <a href="../login/login.php" class="link signup-link">Login</a></span>
                </div>
            </div>

        </div>
    </section>

</body>

</html>