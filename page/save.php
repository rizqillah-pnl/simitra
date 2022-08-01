<?php
include '../controller/config.php';
include '../controller/validateText.php';
session_start();

if (!isset($_SESSION['id'])) {
    header("location:../logout.php");
}


$kode = $_SESSION['id'];
$sql = mysqli_query($conn, "SELECT a.Kode_petugas, a.Username, a.Email, a.Password, a.Old_password, a.Last_login, a.Status, a.Created_at, a.Updated_at, b.Nama, b.NIK, b.Alamat, b.Foto, b.NoHP, b.Tanggal_lahir, b.Tempat_lahir, c.Jabatan, c.Id_jabatan FROM auth a, petugas b, jabatan c WHERE a.Kode_petugas=b.Kode_petugas AND b.Jabatan=c.Id_jabatan AND a.Kode_petugas='$kode'");
$result = mysqli_fetch_assoc($sql);

date_default_timezone_set('Asia/Jakarta');
$now = date("Y-m-d H-i-s");
$insert = mysqli_query($conn, "UPDATE auth SET Last_login='$now' WHERE Kode_petugas='$kode'");


if (isset($_GET['lat']) && isset($_GET['long']) && isset($_GET['kodeBangunan']) && isset($_GET['kepala'])) {
    $lat = $_GET['lat'];
    $long = $_GET['long'];
    $kodeBangunan = null;
    $kepala = null;
    $numKd = "";
    $numKepala = "";


    $latAddr = substr($lat, 0, 8);
    $longAddr = substr($long, 0, 8);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://api.opencagedata.com/geocode/v1/json?key=aed818b3791f4313aeab5e6dfadaeb85&q=$latAddr,$longAddr");

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($result, true);

    if (isset($result['results'][0]['formatted'])) {
        $addr = htmlspecialchars($result['results'][0]['formatted']);
    } else {
        $addr = "";
    }
    // print_r($result['results'][0]['formatted']);
    // die;

    $kodeBangunan = validasi($_GET['kodeBangunan']);
    if ($kodeBangunan == "") {
        $_SESSION['pesan'] = "404";
        header("Location: ../page/maps.php?lat=$lat&long=$long");
    } else {
        $kodeBangunan = str_replace(" ", "", $kodeBangunan);
        $numKd = strlen($kodeBangunan);
    }

    $kepala = validasi($_GET['kepala']);
    if ($kepala == "") {
        $_SESSION['pesan'] = "404";
        header("Location: ../page/maps.php?lat=$lat&long=$long");
    } else {
        $kepala = ucwords($kepala);
        $numKepala = strlen($kepala);
    }

    if ($numKd >= 6 || $numKd == 0) {
        $_SESSION['pesan'] = "404";
        header("Location: maps.php?lat=$lat&long=$long");
    } else {
        if ($numKepala >= 51 || $numKepala <= 2) {
            $_SESSION['pesan'] = "404";
            header("Location: maps.php?lat=$lat&long=$long");
        } else {

            $latNew = substr($lat, 0, 6);
            $longNew = substr($long, 0, 7);


            $cari = mysqli_query($conn, "SELECT * FROM bangunan WHERE No_bangunan='$kodeBangunan' AND Lat LIKE '%$latNew%' AND Lng LIKE '%$longNew%'");
            $result = mysqli_fetch_assoc($cari);

            if (mysqli_num_rows($cari) == 0) {
                $query1 = mysqli_query($conn, "INSERT INTO bangunan(No_bangunan, Alamat, Lat, Lng, Petugas) VALUES ('$kodeBangunan', '$addr', '$lat', '$long', '$kode')");

                $cari = mysqli_query($conn, "SELECT * FROM bangunan WHERE No_bangunan='$kodeBangunan' AND Lat='$lat' AND Lng='$long'");
                $result = mysqli_fetch_assoc($cari);

                $idBangunan = $result['id'];

                $query2 = mysqli_query($conn, "INSERT INTO ruta(Nama_kepala, id_bangunan) VALUES ('$kepala', '$idBangunan')");
                $_SESSION['pesan'] = "200";

                header("Location: ../page/maps.php?lat=$lat&long=$long");
            } else {
                $_SESSION['pesan'] = "404";
                header("Location: ../page/maps.php?lat=$lat&long=$long");
            }
        }
    }
} else {
    header("Location: maps.php");
}
