<?php
include '../controller/config.php';
include '../controller/validateText.php';
include '../controller/uploadImage.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['edit-lowongan'])) {
        $id =  $_POST['id'];
        $jenis = validasi($_POST['jenis']);
        $tglMulai = $_POST['tglmulai'];
        $tglAkhir = $_POST['tglakhir'];
        $syarat = validasi($_POST['syarat']);
        $deskripsi = validasi($_POST['deskripsi']);

        if ((strtotime($tglMulai) + 432000) <= strtotime($tglAkhir)) {
            $gambar = upload('assets');


            if ($gambar != null || $gambar != "") {
                $updateLowongan = mysqli_query($conn, "UPDATE lowongan SET jenis_lowongan='$jenis', tanggal_mulai='$tglMulai', tanggal_akhir='$tglAkhir', persyaratan='$syarat', deskripsi='$deskripsi', gambar='$gambar' WHERE id='$id'");
            } else {
                $updateLowongan = mysqli_query($conn, "UPDATE lowongan SET jenis_lowongan='$jenis', tanggal_mulai='$tglMulai', tanggal_akhir='$tglAkhir', persyaratan='$syarat', deskripsi='$deskripsi' WHERE id='$id'");
            }

            if ($updateLowongan) {
                $_SESSION['pesan'] = 201;
                header("Location: ../page/lowongan.php");
            } else {
                $_SESSION['pesan'] = 301;
                header("Location: ../page/lowongan.php");
            }
        } else {
            $_SESSION['pesan'] = 301;
            header("Location: ../page/lowongan.php");
        }
    }
}

header("Location: ../page/lowongan.php");
