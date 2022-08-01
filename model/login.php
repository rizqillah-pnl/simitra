<?php
include '../controller/config.php';
session_start();

if (isset($_POST['submit'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $_SESSION['username'] = $user;

    $sql = mysqli_query($conn, "SELECT * FROM auth WHERE Username='$user' OR Email='$user'");
    $result = mysqli_fetch_assoc($sql);

    $kode_petugas = $result['Kode_petugas'];
    $sql2 = mysqli_query($conn, "SELECT * FROM petugas WHERE Kode_petugas='$kode_petugas'");
    $result1 = mysqli_fetch_assoc($sql2);

    // Password Hash PHP
    // $cek = password_verify($pass, $result['Password']);

    $kode_petugas = $result['Kode_petugas'];
    date_default_timezone_set('Asia/Jakarta');
    $now = date("Y-m-d H:i:s");
    // echo $now;
    //MD5 Method
    if (md5($pass) == $result['Password']) {
        $insert = mysqli_query($conn, "UPDATE auth SET  Last_login='$now' WHERE Kode_petugas='$kode_petugas'");
        $_SESSION['id'] = $result['Kode_petugas'];
        $_SESSION['password'] = $result['Password'];
        $_SESSION['status'] = "login";
        $_SESSION['Id_jabatan'] = $result1['Jabatan'];
        $_SESSION['welcome'] = $result1['Nama'];

        header("Location: ../page/index.php");
    } else {
        $_SESSION['pesan'] = "unauthorized";
        header("Location: ../page/login.php");
    }
}
