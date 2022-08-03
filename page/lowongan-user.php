<?php
include '../controller/config.php';
session_start();

if (!isset($_SESSION['id'])) {
    header("location:../logout.php");
}


$kode = $_SESSION['id'];
date_default_timezone_set('Asia/Jakarta');
$now = date("Y-m-d H-i-s");
$insert = mysqli_query($conn, "UPDATE auth SET Last_login='$now' WHERE Kode_petugas='$kode'");

$sql = mysqli_query($conn, "SELECT a.Kode_petugas, a.Username, a.Email, a.Password, a.Old_password, a.Last_login, a.Created_at, a.Updated_at, b.Nama, b.NIK, b.Alamat, b.Foto, b.NoHP, b.Tanggal_lahir, b.Tempat_lahir, c.Jabatan, c.Id_jabatan FROM auth a, petugas b, jabatan c WHERE a.Kode_petugas=b.Kode_petugas AND b.Jabatan=c.Id_jabatan AND a.Kode_petugas='$kode' ORDER BY c.Id_jabatan");

$result1 = mysqli_fetch_assoc($sql);


$jumlahDataPerHalaman = 10;
$jumData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) FROM auth"));
$jumlahHalaman = ceil($jumData['COUNT(*)'] / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


$data = mysqli_query($conn, "SELECT a.Kode_petugas, a.Username, a.Email, a.Password, a.Old_password, a.Last_login, a.Created_at, a.Updated_at, b.Nama, b.NIK, b.Alamat, b.Foto, b.NoHP, b.Tanggal_lahir, b.Tempat_lahir, c.Jabatan, c.Id_jabatan FROM auth a, petugas b, jabatan c WHERE a.Kode_petugas=b.Kode_petugas AND b.Jabatan=c.Id_jabatan ORDER BY b.Jabatan, a.Last_login DESC LIMIT $awalData, $jumlahDataPerHalaman");

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>Lowongan Terdaftar | GeoBase</title>
    <?php include 'meta.php'; ?>
</head>

<body>
    <?php $url = "../"; ?>
    <?php include 'header.php'; ?>




    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar" id="navbar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>

                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile.php" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Profile</span></a></li>

                    <li class="sidebar-item" style="background-color: #1a9bfc; border-radius: 9px"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="lowongan-user.php" aria-expanded="false"><i class="mdi mdi-worker text-white"></i><span class="hide-menu text-white">Lowongan Terdaftar</span></a></li>

                    <?php if ($result1['Id_jabatan'] == 1) {  ?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="lowongan.php" aria-expanded="false"><i class="mdi mdi-file-document-box"></i><span class="hide-menu">Daftar Lowongan</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="user.php" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Account</span></a></li>
                    <?php } ?>

                    <li class="sidebar-item logout-item" style="position: fixed; bottom: 0; width: 220px">
                        <button class="dropdown-item border-0 btn btn-link" data-bs-toggle="modal" data-bs-target="#Logout"><i class="m-r-10 mdi mdi-logout">
                            </i><span class="hide-menu">
                                Logout</span></button>
                        <!-- <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../logout.php" aria-expanded="false"><i class="m-r-10 mdi mdi-logout">
                            </i><span class="hide-menu">Logout</span>
                        </a> -->
                    </li>
                </ul>

            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb" style="padding-bottom: 0; padding-top: 0;">
            <div class="row align-items-center">
                <div class="col-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 d-flex align-items-center">
                            <li class="breadcrumb-item"><a href="index.php" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pekerjaan</li>
                        </ol>
                    </nav>
                    <h1 class="mb-0 fw-bold">Lowongan Terdaftar</h1>
                </div>
                <div class="col-6">

                </div>
            </div>
        </div>

        <?php
        if (isset($_SESSION['pesan'])) :
            $pesan =  $_SESSION['pesan'];
        ?>
            <?php
            if ($pesan == "gagal") :
            ?>
                <script>
                    swal("Gagal!", "Username Telah Digunakan!", "warning");
                </script>
            <?php
            elseif ($pesan == "error") :
            ?>
                <script>
                    swal("Gagal!", "Menambahkan Akun Baru!", "warning");
                </script>
            <?php
            elseif ($pesan == "berhasil") :
            ?>
                <script>
                    swal("Berhasil", "Menambahkan Akun Baru!", "success");
                </script>
            <?php elseif ($pesan == "1") :
            ?>
                <script>
                    swal("Gagal!", "Akun Sedang Melakukan Pendataan Bangunan!", "warning");
                </script>
            <?php
            elseif ($pesan == "ok") :
            ?>
                <div class="alert alert-info d-flex align-items-center" role="alert">
                    <div>
                        <?php if (isset($_SESSION['message'])) : ?>
                            <ul>
                                <?php foreach ($_SESSION['message'] as $pesan) : ?>
                                    <li><?= $pesan; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>

            <?php else : ?>
                <script>
                    swal("Gagal!", "Menghapus Akun!", "warning");
                </script>
            <?php endif; ?>
        <?php endif; ?>


        <?php if (isset($_SESSION['delete-account'])) : ?>

            <script>
                let nama = "<?= $_SESSION['delete-account']; ?>";
                swal("Berhasil", "Menghapus Akun " + nama + "!", "success");
            </script>
        <?php endif;
        unset($_SESSION['delete-account']);
        unset($_SESSION['pesan']);
        unset($_SESSION['message']);
        ?>

        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <div class="table-responsive" id="container">
                <table class="table table-hover align-middle text-nowrap table-striped">
                    <thead class="table-dark">
                        <tr class="fw-semibold text-center">
                            <td style="width: 10px;">No</td>
                            <td>Nama Pekerjaan</td>
                            <td>Deskripsi</td>
                            <td>Persyaratan</td>
                            <td>Tanggal Daftar</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <?php $no = $awalData; ?>
                    <tbody>
                        <?php $lowongan = mysqli_query($conn, "SELECT tb_lowongan_user.id as idDaftar, tb_lowongan_user.id_lowongan, tb_lowongan_user.id_petugas, tb_lowongan_user.tanggal_daftar, lowongan.jenis_lowongan, lowongan.tanggal_mulai, lowongan.tanggal_akhir, lowongan.persyaratan, lowongan.deskripsi, lowongan.gambar FROM tb_lowongan_user LEFT JOIN lowongan ON lowongan.id=tb_lowongan_user.id_lowongan WHERE tb_lowongan_user.id_petugas='$kode' ORDER BY tb_lowongan_user.id DESC LIMIT $awalData, $jumlahDataPerHalaman"); ?>
                        <?php if (mysqli_num_rows($lowongan) != 0) : ?>
                            <?php foreach ($lowongan as $row) : ?>
                                <tr class="text-start">
                                    <td scope="row" style="padding-bottom: 0; padding-top: 0; width: 1px;">
                                        <p class="text-dark"><?= $no = $no + 1; ?></p>
                                    </td>

                                    <td class="text-center text-dark" style="padding-bottom: 0; padding-top: 0;">
                                        <?= $row['jenis_lowongan']; ?>
                                    </td>
                                    <td class="text-start text-dark text-wrap text-break" style="padding-bottom: 0; padding-top: 0; width: 10rem;">
                                        <?= $row['deskripsi']; ?>
                                    </td>
                                    <td class="text-start text-dark text-wrap text-break" style="padding-bottom: 0; padding-top: 0;width: 10rem;">
                                        <?= $row['persyaratan']; ?>
                                    </td>
                                    <td class="text-center text-dark" style="padding-bottom: 0; padding-top: 0;">
                                        <?= date('d M Y | H:i', strtotime($row['tanggal_daftar'])); ?> WIB
                                    </td>

                                    <td style="padding-top: 5px; padding-bottom: 10px;">
                                        <div class="row" style="padding-right: 0; padding-left: 0;">
                                            <button type="button" class="btn btn-success mt-1 text-center  text-white" data-bs-toggle="modal" data-bs-target="#Detail<?= $row['idDaftar']; ?>"><i class="mdi mdi-eye"></i> Lihat</button>
                                        </div>
                                        <div class="row" style="padding-right: 0; padding-left: 0;">
                                            <button type="button" class="btn btn-danger mt-1 text-white text-center" data-bs-toggle="modal" data-bs-target="#Delete<?= $row['idDaftar']; ?>"> <i class="mdi mdi-account-remove"></i> Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <td class="text-center text-secondary fw-bold" colspan="6">
                                <img src="../public/img/assets/website-development.png" height="400" alt="Not Found">
                                <p style="font-size: 15px;">Belum Mendaftar Lowongan! <a href="index.php">Daftar Disini</a></p>
                            </td>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if (mysqli_num_rows($lowongan) != 0) : ?>
                <div class="col mt-2" style="position: absolute; right: 150px">
                    <nav aria-label="...">
                        <ul class="pagination">

                            <?php if ($halamanAktif > 1) : ?>
                                <li class="page-item">
                                    <span class="page-link"><a href="?page=<?= $halamanAktif - 1; ?>" style="text-decoration: none;">Previous</a></span>
                                </li>
                            <?php else : ?>
                                <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                <?php if ($i == $halamanAktif) : ?>
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link"><a href="?page=<?= $i; ?>" class="text-white" style="text-decoration: none;"><?= $i; ?></a></span>
                                    </li>
                                <?php else : ?>
                                    <li class="page-item"><a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a></li>
                                <?php endif; ?>
                            <?php endfor; ?>

                            <?php if ($halamanAktif < $jumlahHalaman) : ?>
                                <li class="page-item">
                                    <span class="page-link"><a href="?page=<?= $halamanAktif + 1; ?>" style="text-decoration: none;">Next</a></span>
                                </li>
                            <?php else : ?>
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            <?php endif; ?>
        </div>

        <?php if (mysqli_num_rows($lowongan) != 0) : ?>
            <?php foreach ($lowongan as $row) : ?>
                <!-- Modal Delete -->
                <div class="modal fade " id="Delete<?= $row['idDaftar']; ?>" tabindex="-1" aria-labelledby="DeleteLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="DeleteLabel">Hapus Pekerjaan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Anda yakin ingin menghapus Pekerjaan <strong><?= $row['jenis_lowongan']; ?></strong>?
                            </div>
                            <div class="modal-footer">
                                <form action="../model/delete-lowongan-user.php" method="POST">
                                    <input type="hidden" name="idDaftar" value="<?= $row['idDaftar']; ?>">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" name="submit" class="btn btn-danger text-white">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Detail -->
                <div class="modal fade " id="Detail<?= $row['idDaftar']; ?>" tabindex="-1" aria-labelledby="DetailLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="DetailLabel">Detail Pekerjaan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <center><img src="../public/img/assets/<?= $row['gambar']; ?>" alt="gambar lowongan" class="rounded-circle img-thumbnail" width="400px">
                                </center>
                                <table class="table table-striped-columns">
                                    <tr>
                                        <td>
                                            Kode Pekerjaan
                                        </td>
                                        <td> : </td>
                                        <td><?= $row['id_lowongan']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Nama Pekerjaan
                                        </td>
                                        <td> : </td>
                                        <td><?= $row['jenis_lowongan']; ?></td>
                                    </tr>

                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Modal Tambah User -->
        <div class="modal fade " id="TambahUser" tabindex="-1" aria-labelledby="TambahUserLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="TambahUserLabel">Tambah Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../model/tambah-user.php" method="POST">
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <label for="nama" class="col-md-4 col-form-label">Nama Petugas</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nama" class="form-control" id="nama" required maxlength="25">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password" class="col-md-4 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" name="password" class="form-control" id="password" required maxlength="50">
                                </div>
                            </div>
                            <?php $q = mysqli_query($conn, "SELECT * FROM jabatan"); ?>
                            <div class="mb-3 row">
                                <label class="col-md-4 col-form-label">Jabatan</label>
                                <div class="col-sm-8">
                                    <select class="form-select" name="jabatan" aria-label="Default select example">
                                        <?php foreach ($q as $row) : ?>
                                            <?php if ($row['Id_jabatan'] == "2") : ?>
                                                <option value="<?= $row['Id_jabatan']; ?>" selected><?= $row['Jabatan']; ?></option>
                                            <?php else : ?>
                                                <option value="<?= $row['Id_jabatan']; ?>"><?= $row['Jabatan']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" name="tambah-user" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <?php include 'footer.php'; ?>