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

$data = mysqli_query($conn, "SELECT a.Kode_petugas, a.Username, a.Email, a.Password, a.Old_password, a.Last_login, a.Created_at, a.Updated_at, b.Nama, b.NIK, b.Alamat, b.Foto, b.NoHP, b.Tanggal_lahir, b.Tempat_lahir, b.Jkel, c.Jabatan, c.Id_jabatan FROM auth a, petugas b, jabatan c WHERE a.Kode_petugas=b.Kode_petugas AND b.Jabatan=c.Id_jabatan AND a.Kode_petugas='$kode' ORDER BY c.Id_jabatan");


$result1 = mysqli_fetch_assoc($data);



?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>Dashboard | Simitra</title>
    <?php include 'meta.php'; ?>
</head>

<body>

    <?php $url = "../"; ?>
    <?php include 'header.php'; ?>


    <!-- Alert Selamat Datang -->
    <?php $login = ""; ?>
    <?php if (isset($_SESSION['welcome'])) {
        $login = $_SESSION['welcome'];
    } else {
        $login = "";
    } ?>

    <script>
        let login = "<?= $login ?>";

        console.log(login);

        if (login != "") {
            swal("Selamat Datang", "@" + login, "success");
        }
    </script>
    <?php if (isset($_SESSION['pesan'])) :
        $pesan = $_SESSION['pesan'];
    ?>
        <?php if ($pesan == "pesan-dihapus") : ?>
            <script>
                swal("Berhasil!", "Pesan Berhasil Dihapus!", "success");
            </script>

        <?php elseif ($pesan == "pesan-gagal") : ?>
            <script>
                swal("Gagal!", "Pesan Gagal Dihapus!", "warning");
            </script>
        <?php endif; ?>
    <?php endif; ?>


    <?php unset($_SESSION['welcome']);
    unset($_SESSION['pesan']);
    ?>


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
                    <li class="sidebar-item" style="background-color: #1a9bfc; border-radius: 9px"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false"><i class="mdi mdi-view-dashboard text-white"></i><span class="hide-menu text-white">Dashboard</span></a></li>

                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile.php" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Profile</span></a></li>

                    <?php if ($result1['Id_jabatan'] == 1 || $result1['Id_jabatan'] == 2) {  ?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="user.php" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Account</span></a></li>
                    <?php } ?>

                    <li class="sidebar-item logout-item" style="position: fixed; bottom: 0; width: 220px">
                        <button class="dropdown-item border-0 btn btn-link" data-bs-toggle="modal" data-bs-target="#Logout"><i class="m-r-10 mdi mdi-logout">
                            </i><span class="hide-menu">
                                Logout</span>
                        </button>
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
                            <li class="breadcrumb-item"><a href="#" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                    <h1 class="mb-0 fw-bold">Dashboard</h1>
                </div>
                <div class="col-6">

                </div>
            </div>
        </div>


        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Sales chart -->
            <!-- ============================================================== -->
            <div class="row">

                <!-- column daftar bangunan terbaru -->
                <div class="col-lg">
                    <div class="card">
                        <div class="card-body" style="padding-bottom: 15px; padding-top: 25px;">
                            <!-- title -->
                            <div class="d-md-flex">
                                <div>
                                    <h4 class="card-title">Daftar Lowongan</h4>
                                    <h6 class="card-subtitle">Daftar Lowongan Pekerjaan</h6>

                                    <div class="row">
                                        <?php $dataLowongan = mysqli_query($conn, "SELECT * FROM lowongan"); ?>

                                        <?php foreach ($dataLowongan as $row) : ?>
                                            <div class="col-6">
                                                <div class="card" style="width: 18rem;">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?= $row['jenis_lowongan']; ?></h5>
                                                        <p class="card-text"><?= $row['deskripsi']; ?></p>
                                                        <div class="card-text mb-3">Tanggal : <?= $row['tanggal']; ?></div>
                                                        <div class="text-end"><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal<?= $row['id']; ?>">Daftar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modal<?= $row['id']; ?>" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLabel"><?= $row['jenis_lowongan']; ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table>
                                                                <tr>
                                                                    <td>Deskripsi</td>
                                                                    <td>:</td>
                                                                    <td><?= $row['deskripsi']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Persyaratan</td>
                                                                    <td>:</td>
                                                                    <td><?= $row['persyaratan']; ?></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <form action="../model/lowongan.php" method="post">
                                                            <input type="hidden" name="idLowongan" value="<?= $row['id']; ?>">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="button" class="btn btn-primary">Daftar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Recent comment and chats -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->


        <?php
        include 'footer.php';
        ?>