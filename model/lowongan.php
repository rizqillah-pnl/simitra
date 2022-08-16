<?php
include '../controller/config.php';
include '../controller/validateText.php';

session_start();
$kode = $_SESSION['id'];

$sql = mysqli_query($conn, "SELECT a.Kode_petugas, a.Username, a.Email, a.Password, a.Old_password, a.Last_login, a.Created_at, a.Updated_at, b.Nama, b.NIK, b.Alamat, b.Foto, b.NoHP, b.Tanggal_lahir, b.Tempat_lahir, c.Jabatan, c.Id_jabatan FROM auth a, petugas b, jabatan c WHERE a.Kode_petugas=b.Kode_petugas AND b.Jabatan=c.Id_jabatan AND a.Kode_petugas='$kode'");
$result = mysqli_fetch_assoc($sql);

if (isset($_POST['daftarLowongan'])) {
    $idLowongan = $_POST['idLowongan'];
    
    $cari = mysqli_query($conn, "SELECT * FROM tb_lowongan_user WHERE id='$idLowongan' AND id_petugas='$kode'");
    if (mysqli_num_rows($cari) == 0) {

        date_default_timezone_set('Asia/Jakarta');
        $now = date("Y-m-d H-i-s");
        $daftar = mysqli_query($conn, "INSERT INTO tb_lowongan_user (id_lowongan, id_petugas, id_kec, tanggal_daftar) VALUES ('$idLowongan', '$kode', $id_kec', '$now')");

        if ($daftar) {
            $_SESSION['pesan'] = "berhasil";
            header("Location: ../page/index.php");
        } else {
            $_SESSION['pesan'] = "gagal";
            header("Location: ../page/index.php");
        }
    } else {
        $_SESSION['pesan'] = "already";
        header("Location: ../page/index.php");
    }
}