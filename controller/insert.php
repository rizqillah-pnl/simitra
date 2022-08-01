<?php
$conn = mysqli_connect("sqlXXX.epizy.com", "epiz_32165899", "N7YFshmT3yB52j", "epiz_32165899_isnani");

if (mysqli_connect_error()) {
    echo "Koneksi Gagal!";
}


if (isset($_GET['ketinggian']) && isset($_GET['status'])) {
    $ketinggian = $_GET['ketinggian'];
    $status = $_GET['status'];

    $insert = mysqli_query($conn, "INSERT INTO jembatan (ketinggian, status) VALUES ('$ketinggian', '$status')");

    if ($insert) {
        echo "Data berhasil diinput!";
    } else {
        echo "Data gagal diinput!";
    }
} else {
    echo "Mohon kirimkan data lewat URL!";
}
