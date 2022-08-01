<?php
include '../controller/config.php';
include '../controller/validateText.php';

session_start();
$kode = $_SESSION['id'];

$sql = mysqli_query($conn, "SELECT a.Kode_petugas, a.Username, a.Email, a.Password, a.Old_password, a.Last_login, a.Status, a.Created_at, a.Updated_at, b.Nama, b.NIK, b.Alamat, b.Foto, b.NoHP, b.Tanggal_lahir, b.Tempat_lahir, c.Jabatan, c.Id_jabatan FROM auth a, petugas b, jabatan c WHERE a.Kode_petugas=b.Kode_petugas AND b.Jabatan=c.Id_jabatan AND a.Kode_petugas='$kode'");
$result = mysqli_fetch_assoc($sql);

date_default_timezone_set('Asia/Jakarta');
$now = date("Y-m-d H-i-s");

// update profil oleh user
if (isset($_POST['edit'])) {
    if (empty($_POST['nama'])) {
        $_SESSION['pesan'] = "nama";
        header("Location: ../page/profile.php");
    } else {
        if (empty($_POST['email'])) {
            $_SESSION['pesan'] = "email";
            header("Location: ../page/profile.php");
        } else {
            $nama = validasi($_POST['nama']);
            $email = $_POST['email'];
            $tgllahir = $_POST['tgllahir'];

            $alamat = null;
            $nohp = null;
            $tmplahir = null;


            // Fungsi validasi text inputan
            if (!empty($_POST['alamat'])) {
                $alamat = $_POST['alamat'];

                $alamat = validasi($alamat);
                if ($alamat == "") {
                    $alamat = null;
                }
            }

            if (!empty($_POST['nohp'])) {
                $nohp = $_POST['nohp'];

                $nohp = validasi($nohp);
                if ($nohp == "") {
                    $nohp = null;
                }
            }

            if (!empty($_POST['tmplahir'])) {
                $tmplahir = $_POST['tmplahir'];

                $tmplahir = validasi($tmplahir);
                if ($tmplahir == "") {
                    $tmplahir = null;
                }
            }


            $gambar = upload();

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['pesan'] = "email";
                header("Location: ../page/profile.php");
            } else {
                if ($gambar == false) {
                    $sql3 = "UPDATE petugas SET Nama='$nama', NoHP='$nohp', Tanggal_lahir='$tgllahir', Tempat_lahir='$tmplahir', Alamat='$alamat' WHERE Kode_petugas='$kode'";
                    $query1 = mysqli_query($conn, $sql3);
                } else {
                    $sql3 = "UPDATE petugas SET Nama='$nama', NoHP='$nohp', Tanggal_lahir='$tgllahir', Tempat_lahir='$tmplahir', Alamat='$alamat', Foto='$gambar' WHERE Kode_petugas='$kode'";
                    $query2 = mysqli_query($conn, $sql3);
                }

                $sql = "UPDATE auth SET Updated_at='$now', Email='$email' WHERE Kode_petugas='$kode'";
                $query = mysqli_query($conn, $sql);
                $_SESSION['pesan'] = "200";
                header("Location: ../page/profile.php");
            }
        }
    }
}


// ganti password oleh user
if (isset($_POST['change'])) {
    $password = $_POST['password'];
    $passlama = $_POST['passlama'];

    if (md5($passlama) == $result['Password']) {
        if ($password != $passlama) {
            $password = md5($password);

            $sql3 = "UPDATE auth SET Password='$password', Updated_at='$now' WHERE Kode_petugas='$kode'";
            $query2 = mysqli_query($conn, $sql3);

            $_SESSION['pesan'] = "200";
            header("Location: ../page/profile.php");
        } else {
            $_SESSION['pesan'] = "2";
            header("Location: ../page/profile.php");
        }
    } else {
        $_SESSION['pesan'] = "1";
        header("Location: ../page/profile.php");
    }
}



// update akun oleh admin atau koseka
if (isset($_POST['edit-user'])) {
    $kode_petugas = $_POST['kode_petugas'];
    $username = $_POST['username'];
    $usernameAsli = $_POST['usernameAsli'];
    $email = $_POST['email'];
    $emailAsli = $_POST['emailAsli'];
    $password = $_POST['password'];
    $jabatan = $_POST['jabatan'];
    $passwordAsli = $_POST['passwordAsli'];
    $_SESSION['edit-account'] = $username;

    $sql = "";
    $pesan = [];


    $username = strtolower($username);
    $username = htmlspecialchars(str_replace(' ', '', $username));


    if ($username != $usernameAsli) {
        if (cekUsername($username)) {
            $sql3 = mysqli_query($conn, "UPDATE auth SET Username='$username' WHERE Kode_petugas='$kode_petugas'");
            $pesan['username'] = "Username berhasil diganti!";
        } else {
            $pesan['username'] = "Username telah digunakan!";
        }
    }

    if ($email != $emailAsli) {
        if (cekUsername($email)) {
            $sql4 = mysqli_query($conn, "UPDATE auth SET Email='$email' WHERE Kode_petugas='$kode_petugas'");
            $pesan['email'] = "Email berhasil diganti!";
        } else {
            $pesan['email'] = "Email telah digunakan!";
        }
    }

    if ($password != "") {
        $password = md5($password);
        $cek = mysqli_query($conn, "SELECT * FROM auth WHERE Kode_petugas='$kode' AND Password='$password'");
        $result = mysqli_num_rows($cek);

        if ($result == 0) {
            $sql = mysqli_query($conn, "UPDATE auth SET Password='$password', Old_password='$passwordAsli' WHERE Kode_petugas='$kode_petugas'");
            $pesan['password'] = "Password berhasil diganti!";
        } else {
            $pesan['password'] = "Password tidak boleh sama dengan password lama!";
        }
    }


    $sql2 = mysqli_query($conn, "UPDATE petugas SET Jabatan='$jabatan' WHERE Kode_petugas='$kode_petugas'");
    $sql5 = mysqli_query($conn, "UPDATE auth SET Updated_at='$now' WHERE Kode_petugas='$kode_petugas'");
    $_SESSION['pesan'] = "ok";

    if (!isset($pesan['username'])) {
        if (!isset($pesan['email'])) {
            if (!isset($pesan['password'])) {
                if ($sql2) {
                    $pesan['success'] = "Proses edit berhasil!";
                    $_SESSION['message'] = $pesan;


                    header("Location: ../page/user.php");
                } else {
                    $pesan['jabatan'] = "Jabatan gagal diubah!";
                    $_SESSION['message'] = $pesan;
                    header("Location: ../page/user.php");
                }
            }

            $_SESSION['message'] = $pesan;
            header("Location: ../page/user.php");
        }
        $_SESSION['message'] = $pesan;

        header("Location: ../page/user.php");
    }
    $_SESSION['message'] = $pesan;
    header("Location: ../page/user.php");
}


// fungsi cek email atau username
function cekUsername($username)
{
    include '../Controller/config.php';
    $sql = mysqli_query($conn, "SELECT * FROM auth WHERE Username='$username' OR Email='$username'");

    $result = mysqli_num_rows($sql);

    if ($result == 1) {
        return false;
    } else {
        return true;
    }
}


// fungsi upload gambar
function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    // $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    // $tipeFile = $_FILES['gambar']['type'];
    $tmpName = $_FILES['gambar']['tmp_name'];
    date_default_timezone_set('Asia/Jakarta');
    $now = date("Y-m-d H-i-s");

    // cek ada atau tidak ada di upload gambar
    if ($error === 4) {
        return false;
    }
    // upload file
    move_uploaded_file($tmpName, '../public/img/user/' . $now . $namaFile);

    return $now . $namaFile;
}
