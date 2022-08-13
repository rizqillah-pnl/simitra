<?php
include '../controller/config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['delete-lowongan'])) {
        $id =  $_POST['id'];
        $deleteLowongan = mysqli_query($conn, "DELETE FROM lowongan WHERE id='$id'");

        if ($deleteLowongan) {
            $_SESSION['pesan'] = 202;
            header("Location: ../page/lowongan.php");
        } else {
            $_SESSION['pesan'] = 302;
            header("Location: ../page/lowongan.php");
        }
    } else {
        header("Location: ../page/lowongan.php");
    }
}

header("Location: ../page/lowongan.php");
