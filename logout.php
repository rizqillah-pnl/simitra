<?php
include 'controller/config.php';
session_start();
$kode = $_SESSION['id'];


date_default_timezone_set('Asia/Jakarta');
$now = date("Y-m-d H:i:s");
$insert = mysqli_query($conn, "UPDATE auth SET Last_login='$now' WHERE Kode_petugas='$kode'");
session_destroy();


    header('Location: index.php');



// if (isset($_GET['change'])) {
//     header("Location: page/login.php");
// } else {
//     header('Location: index.php');
// }