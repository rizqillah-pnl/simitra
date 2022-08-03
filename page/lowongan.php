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

if ($result1['Id_jabatan'] == "1") :

    $jumlahDataPerHalaman = 10;
    $jumData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) FROM auth"));
    $jumlahHalaman = ceil($jumData['COUNT(*)'] / $jumlahDataPerHalaman);
    $halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


    $data = mysqli_query($conn, "SELECT * FROM lowongan LIMIT $awalData, $jumlahDataPerHalaman");



?>

    <!DOCTYPE html>
    <html dir="ltr" lang="en">

    <head>
        <title>Daftar Lowongan | GeoBase</title>
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

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="lowongan-user.php" aria-expanded="false"><i class="mdi mdi-worker"></i><span class="hide-menu">Lowongan Terdaftar</span></a></li>

                        <?php if ($result1['Id_jabatan'] == 1) {  ?>
                            <li class="sidebar-item" style="background-color: #1a9bfc; border-radius: 9px"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="lowongan.php" aria-expanded="false"><i class="mdi mdi-file-document-box text-white"></i><span class="hide-menu text-white">Daftar Lowongan</span></a></li>

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
                                <li class="breadcrumb-item active" aria-current="page">Lowongan</li>
                            </ol>
                        </nav>
                        <h1 class="mb-0 fw-bold">Daftar Lowongan</h1>
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
                <div class="row">
                    <div class="col-lg">
                        <div class="mb-0">
                            <button type="button" class="btn btn-primary text-white text-center mb-2" data-bs-toggle="modal" data-bs-target="#TambahUser"><i class="mdi mdi-account-plus"></i> Tambah User</button>
                        </div>
                    </div>
                    <!-- 
                    <div class="col-lg">
                        <div class="d-flex flex-row-reverse mb-3">
                            <input type="text" style="height: 35px; width: 100%;" name="search" id="search" placeholder="Search . . ." autocomplete="off" class="form-control" autofocus>
                        </div>
                    </div> -->
                </div>

                <div class="table-responsive" id="container">
                    <table class="table table-hover align-middle text-nowrap table-striped">
                        <thead class="table-dark">
                            <tr class="fw-semibold text-center">
                                <td>No</td>
                                <td>Action</td>
                                <td>Kode Lowongan</td>
                                <td>Nama Lowongan</td>
                                <td>Deskripsi</td>
                                <td>Tanggal Pekerjaan</td>
                            </tr>
                        </thead>
                        <?php $no = $awalData; ?>
                        <tbody>
                            <?php if (mysqli_num_rows($data) != 0) : ?>
                                <?php foreach ($data as $row) : ?>
                                    <tr class="text-start">
                                        <td scope="row" style="padding-bottom: 0; padding-top: 0;">
                                            <p class="text-dark"><?= $no = $no + 1; ?></p>
                                        </td>
                                        <td class="row" style="padding-bottom: 0; padding-top: 0;">
                                            <div class="col" style="padding: 0; margin: 0;">
                                                <button type="button" class="btn btn-success mt-1 text-center  text-white" data-bs-toggle="modal" data-bs-target="#Detail<?= $row['id']; ?>"><i class="mdi mdi-eye"></i></button>
                                            </div>
                                            <div class="col" style="padding: 0; margin: 0;">
                                                <button type="button" class="btn btn-warning mt-1 text-center" data-bs-toggle="modal" data-bs-target="#Edit<?= $row['id']; ?>"><i class="mdi mdi-pencil"></i></button>
                                            </div>
                                            <div class="col" style="padding: 0; margin: 0;">
                                                <button type="button" class="btn btn-danger mt-1 text-white text-center" data-bs-toggle="modal" data-bs-target="#Delete<?= $row['id']; ?>"> <i class="mdi mdi-account-remove"></i></button>
                                            </div>
                                        </td>
                                        <td class="text-center text-dark" style="padding-bottom: 0; padding-top: 0;">
                                            <?= $row['id']; ?>
                                        </td>
                                        <td class="text-start text-dark text-wrap text-break" style="padding-bottom: 0; padding-top: 0; width: 10rem;">
                                            <?= $row['jenis_lowongan']; ?>
                                        </td>
                                        <td class="text-start text-dark text-wrap text-break" style="padding-bottom: 0; padding-top: 0;width: 10rem;">
                                            <?= $row['deskripsi']; ?>
                                        </td>
                                        <td class="text-center text-dark" style="padding-bottom: 0; padding-top: 0;">
                                            <?= date('d M Y', strtotime($row['tanggal_mulai'])); ?> &#8594;
                                            <?= date('d M Y', strtotime($row['tanggal_akhir'])); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php if (mysqli_num_rows($data) != 0) : ?>
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

            <?php if (mysqli_num_rows($data) != 0) : ?>
                <?php foreach ($data as $row) : ?>
                    <!-- Modal Edit -->
                    <div class="modal fade " id="Edit<?= $row['id']; ?>" tabindex="-1" aria-labelledby="EditLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="EditLabel">Edit Akun</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="../model/edit-lowongan.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                    <div class="modal-body">
                                        <div class="mb-3 row">
                                            <label for="Nama_Pekerjaan" class="col-md-4 col-form-label">Nama Pekerjaan</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="Nama_Pekerjaan" class="form-control" id="user" value="<?= $row['jenis_lowongan']; ?>" oninput="this.value = this.value.toLowerCase()" maxlength="25">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="email" class="col-md-4 col-form-label">Email</label>
                                            <div class="col-sm-8">
                                                <input type="email" name="email" class="form-control" id="emai" value="<?= $row['Email']; ?>" oninput="this.value = this.value.toLowerCase()" maxlength="100">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="password" class="col-md-4 col-form-label">Password</label>
                                            <div class="col-sm-8">
                                                <input type="password" name="password" class="form-control" id="password1" maxlength="50">
                                            </div>
                                        </div>
                                        <?php $q = mysqli_query($conn, "SELECT * FROM jabatan"); ?>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 col-form-label">Jabatan</label>
                                            <div class="col-sm-8">
                                                <select class="form-select" name="jabatan" aria-label="Default select example">
                                                    <?php foreach ($q as $jabatan) : ?>
                                                        <?php if ($_SESSION['Id_jabatan'] == "1") : ?>
                                                            <?php if ($jabatan['Id_jabatan'] == $row['Id_jabatan']) : ?>
                                                                <option value="<?= $jabatan['Id_jabatan']; ?>" selected>
                                                                    <?= $jabatan['Jabatan']; ?></option>
                                                                <?php continue; ?>
                                                            <?php endif; ?>
                                                            <option value="<?= $jabatan['Id_jabatan']; ?>"><?= $jabatan['Jabatan']; ?>
                                                            </option>
                                                            <?php continue; ?>
                                                        <?php elseif ($jabatan['Id_jabatan'] == "1" || $jabatan['Id_jabatan'] == "2" && $result1['Id_jabatan'] == "2") : ?>
                                                            <?php continue; ?>
                                                        <?php endif; ?>
                                                        <?php if ($jabatan['Id_jabatan'] == $row['Id_jabatan']) : ?>
                                                            <option value="<?= $jabatan['Id_jabatan']; ?>" selected>
                                                                <?= $jabatan['Jabatan']; ?></option>
                                                            <?php continue; ?>
                                                        <?php endif; ?>
                                                        <option value="<?= $jabatan['Id_jabatan']; ?>"><?= $jabatan['Jabatan']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" name="edit-user" class="btn btn-warning">Edit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Delete -->
                    <div class="modal fade " id="Delete<?= $row['id']; ?>" tabindex="-1" aria-labelledby="DeleteLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DeleteLabel">Hapus Lowongan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Anda yakin ingin menghapus lowongan <strong><?= $row['jenis_lowongan']; ?></strong>?
                                </div>
                                <div class="modal-footer">
                                    <form action="../model/delete-lowongan.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" name="submit" class="btn btn-danger text-white">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Detail -->
                    <div class="modal fade " id="Detail<?= $row['id']; ?>" tabindex="-1" aria-labelledby="DetailLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DetailLabel">Detail Lowongan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <center><img src="../public/img/assets/<?= $row['gambar']; ?>" alt="Foto Profil" class="rounded-circle img-thumbnail" width="400px">
                                    </center>
                                    <table class="table table-striped-columns">
                                        <tr>
                                            <td>
                                                Kode Lowongan
                                            </td>
                                            <td> : </td>
                                            <td><?= $row['id']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Nama Lowongan
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
        <?php else : ?>
            <?php header("Location: ../index.php"); ?>
        <?php endif; ?>