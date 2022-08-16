<?php
include '../controller/config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submit'])) {
        $id =  $_POST['id'];
        $url = $_POST['url'];
        $deleteLowonganUser = mysqli_query($conn, "DELETE FROM tb_lowongan_user WHERE id='$id'");

        if ($deleteLowonganUser) {
            $_SESSION['pesan'] = 205;
            header("Location: ../page/$url");
        } else {
            $_SESSION['pesan'] = 305;
            header("Location: ../page/$url");
        }
    } else {
        header("Location: ../page/$url");
    }
}

header("Location: ../page/$url");
