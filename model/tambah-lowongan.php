<?php
include '../controller/config.php';
include '../controller/validateText.php';
include '../controller/uploadImage.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['tambah-lowongan'])) {
        $jenis = validasi($_POST['jenis']);
        $tglMulai = $_POST['tglmulai'];
        $tglAkhir = $_POST['tglakhir'];
        $syarat = validasi($_POST['syarat']);
        $deskripsi = validasi($_POST['deskripsi']);

        if ((strtotime($tglMulai) + 432000) <= strtotime($tglAkhir)) {
            $gambar = upload('assets');

            $insertLowongan = mysqli_query($conn, "INSERT INTO lowongan (jenis_lowongan, tanggal_mulai, tanggal_akhir, persyaratan, deskripsi, gambar) VALUES ('$jenis', '$tglMulai', '$tglAkhir', '$syarat', '$deskripsi', '$gambar')");

            if ($insertLowongan) {
                $_SESSION['pesan'] = 200;
                header("Location: ../page/lowongan.php");
            } else {
                $_SESSION['pesan'] = 300;
                header("Location: ../page/lowongan.php");
            }
        } else {
            $_SESSION['pesan'] = 300;
            header("Location: ../page/lowongan.php");
        }
    }
}

header("Location: ../page/lowongan.php");
