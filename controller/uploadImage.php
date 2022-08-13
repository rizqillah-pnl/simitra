<?php

// fungsi upload gambar
function upload($path)
{
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        return false;
    }

    // cek jika ukurannya terlalu besar
    if ($ukuranFile > 2000000) {
        return false;
    }

    $namaFileWithoutExt = pathinfo($namaFile, PATHINFO_FILENAME);
    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    date_default_timezone_set('Asia/Jakarta');
    $namaFileBaru = date('d-m-Y H-i-s');
    $namaFileBaru .= $namaFileWithoutExt;
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../public/img/' . $path . '/' . $namaFileBaru);

    return $namaFileBaru;
}
