<?php
    include_once "../config/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <center><br>
        <h1>REGISTER</h1>
        <br>

        <form action="../proses/proses-register.php" method="POST">
            <table cellpadding="10">
                <tr>
                    <td>Nama Lengkap</td>
                    <td>
                    <input type="text" name="nama">
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td>Outlet</td>
                    <td>
                        <select name="id_outlet" id="">
                            <?php                               
                                $query = mysqli_query($conn, "SELECT * FROM tb_outlet");
                                while($hasil = mysqli_fetch_assoc($query)){
                            ?>
                            <option value="<?=$hasil['id_outlet'];?>"><?=$hasil['nama'];?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Level User</td>
                    <td>
                        <select name="role" id="">
                            <option value="owner">owner</option>
                            <option value="admin">admin</option>
                            <option value="kasir">kasir</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <!-- <td></td> -->
                    <td><input type="submit" style="float:right" value="Register"></td>
                </tr>
            </table>
        </form>
    </center>

</body>

</html>