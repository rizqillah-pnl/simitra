<?php
include '../controller/config.php';
session_start();
$kode = $_SESSION['id'];

if (isset($_POST['submit'])) {
    $kode_petugas = $_POST['kode_petugas'];

    $sql3 = "SELECT * FROM petugas WHERE Kode_petugas='$kode_petugas'";

    $query2 = mysqli_query($conn, $sql3);
    $result = mysqli_fetch_assoc($query2);

    $sql = "DELETE FROM petugas WHERE Kode_petugas='$kode_petugas'";
    $sql2 = "DELETE FROM auth WHERE Kode_petugas='$kode_petugas'";


    $query = mysqli_query($conn, $sql);

    if ($query) {
        $query = mysqli_query($conn, $sql2);

        if ($query) {
            $_SESSION['delete-account'] = $result['Nama'];
            header("Location: ../page/user.php");
        } else {
            $_SESSION['pesan'] = "2";
            header("Location: ../page/user.php");
        }
    } else {
        $_SESSION['pesan'] = "1";
        header("Location: ../page/user.php");
    }
}
