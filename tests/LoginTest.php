<?php

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    protected function setUp(): void
    {
        // Set up koneksi ke database dan session
        include "../config/config.php";
        session_start();
    }

    public function testLoginSuccess()
    {
        $_POST['username'] = 'admin'; // Ganti dengan username yang valid
        $_POST['password'] = '12345'; // Ganti dengan password yang valid

        // Simulasikan query ke database
        global $conn;
        $query_login = mysqli_query($conn, "SELECT * FROM tb_user WHERE username= '{$_POST['username']}'");
        $data_user = mysqli_fetch_assoc($query_login);

        // Memastikan pengguna ditemukan
        $this->assertNotNull($data_user);

        // Memastikan password yang dimasukkan sesuai
        $this->assertTrue(password_verify($_POST['password'], $data_user['password']));

        // Simulasikan proses login
        if (password_verify($_POST['password'], $data_user['password'])) {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['role'] = $data_user['role'];
            $_SESSION['idOutlet'] = $data_user['id_outlet'];
            $_SESSION['idUser'] = $data_user['id_user'];

            $this->assertEquals('admin', $_SESSION['username']); // Pastikan username disimpan dalam session
        }
    }

    public function testLoginFailure()
    {
        $_POST['username'] = 'wrong_user'; // Username tidak valid
        $_POST['password'] = 'wrong_password'; // Password tidak valid

        // Simulasikan query ke database
        global $conn;
        $query_login = mysqli_query($conn, "SELECT * FROM tb_user WHERE username= '{$_POST['username']}'");
        $data_user = mysqli_fetch_assoc($query_login);

        // Memastikan tidak ada pengguna ditemukan
        $this->assertNull($data_user);
    }
}
