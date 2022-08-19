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

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>Profile | Simitra</title>
    <?php include 'meta.php'; ?>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php $url = "../"; ?>
    <?php include 'header.php'; ?>

    <!-- Pesan Alert -->
    <?php
    if (isset($_SESSION['pesan'])) :
        $pesan = $_SESSION['pesan']; ?>
        <?php if ($pesan == "200") : ?>
            <script>
                swal("Berhasil!", "Update Profile", "success");
            </script>

        <?php elseif ($pesan == "1") : ?>
            <script>
                swal("Gagal Update Password!", "Password Lama Salah!", "warning");
            </script>

        <?php elseif ($pesan == "2") : ?>
            <script>
                swal("Gagal Update Password!", "Password Baru Telah Dipakai", "warning");
            </script>
        <?php elseif ($pesan == "nama") : ?>
            <script>
                swal("Gagal Update Profile!", "Mohon untuk Mengisi Nama!", "warning");
            </script>
        <?php elseif ($pesan == "email") : ?>
            <script>
                swal("Gagal Update Profile!", "Email Tidak Valid!", "warning");
            </script>
        <?php elseif ($pesan == "nik") : ?>
            <script>
                swal("Gagal Update Profile!", "NIK Tidak Valid!", "warning");
            </script>
    <?php endif;
    endif;
    // unset($_SESSION['message']);
    unset($_SESSION['pesan']);
    ?>

    <!-- ============================================================== -->
    <!-- End Topbar header -->
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

                    <li class="sidebar-item" style="background-color: #1a9bfc; border-radius: 9px"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile.php" aria-expanded="false"><i class="fa-solid fa-circle-user"></i><span class="hide-menu text-white">Profile</span></a></li>

                    <?php if ($result1['Id_jabatan'] == 2) :  ?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="lowongan-user.php" aria-expanded="false"><i class="mdi mdi-worker"></i><span class="hide-menu">Lowongan Terdaftar</span></a></li>
                    <?php endif; ?>

                    <?php if ($result1['Id_jabatan'] == 1) {  ?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="lowongan.php" aria-expanded="false"><i class="mdi mdi-file-document-box"></i><span class="hide-menu">Daftar Lowongan</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="seleksi-daftar.php" aria-expanded="false"><i class="mdi mdi-file-document-box "></i><span class="hide-menu ">Seleksi Pendaftar</span></a></li>

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
                            <li class="breadcrumb-item"><a href="../index.php" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                    <h1 class="mb-0 fw-bold">Profile</h1>
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
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- Row -->
            <div class="row">
                <!-- Column -->
                <div class="col-lg-4 col-xlg-3 col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <center class="m-t-30">
                                <?php if (isset($result1['Foto'])) { ?>
                                    <div class="frame" style="overflow: auto; width: 100%;">
                                        <img src="../public/img/user/<?= $result1['Foto']; ?>" style="width: 90%;">
                                    </div>
                                <?php } else { ?>
                                    <div class="frame" style="overflow: auto; width: 100%;">
                                        <img src="../public/img/user/1.jpg" style="width: 90%;">
                                    </div>
                                <?php } ?>

                                <h4 class="card-title m-t-10"><?= ucwords($result1['Nama']); ?></h4>
                                <h6 class="card-subtitle"><?= $result1['Jabatan']; ?></h6>

                            </center>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <div class="card-body">
                            <small class="text-muted">Email address </small>
                            <?php if (isset($result1['Email'])  && $result1['Email'] != "") { ?>
                                <h6><?= $result1['Email']; ?></h6>
                            <?php } else { ?>
                                <h6><i>NULL</i></h6>
                            <?php } ?>
                            <small class="text-muted p-t-30 db">Phone</small>
                            <?php if (isset($result1['NoHP']) && $result1['NoHP'] != "") { ?>
                                <h6><?= $result1['NoHP']; ?></h6>
                            <?php } else { ?>
                                <h6><i>NULL</i></h6>
                            <?php } ?>
                            <small class="text-muted p-t-30 db">Address</small>
                            <?php if (isset($result1['Alamat'])  && $result1['Alamat'] != "") { ?>
                                <h6><?= $result1['Alamat']; ?></h6>
                            <?php } else { ?>
                                <h6><i>NULL</i></h6>
                            <?php } ?>

                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-lg-8 col-xlg-9 col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <form action="../model/edit-user.php" method="POST" enctype="multipart/form-data" class="form-horizontal form-material mx-2">
                                <div class="form-group">
                                    <label class="col-md-12 text-dark" for="nik">NIK</label>
                                    <div class="col-md-12">
                                        <input type="text" id="nik" value="<?= $result1['NIK']; ?>" class="form-control form-control-line" name="nik" maxlength="16" placeholder="Masukkan NIK Anda" required oninput="this.value = this.value.toLowerCase()" required onkeypress="return onlyNumberKey(event)">
                                    </div>
                                </div>

                                <script>
                                    function onlyNumberKey(evt) {
                                        // Hanya code ASCII dalam range itu yang diterima
                                        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
                                        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) {
                                            return false;
                                        }
                                        return true;
                                    }
                                </script>
                                <div class="form-group">
                                    <label class="col-md-12 text-dark" for="nama">Nama Lengkap</label>
                                    <div class="col-md-12">
                                        <input type="text" id="nama" value="<?= ucwords($result1['Nama']); ?>" class="form-control form-control-line" name="nama" maxlength="50" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 text-dark" for="email">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" id="email" value="<?= $result1['Email']; ?>" class="form-control form-control-line" name="email" maxlength="100" placeholder="Masukkan Email Anda" required oninput="this.value = this.value.toLowerCase()">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-Foto" class="col-md-12 text-dark" for="foto">Foto</label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input type="file" id="foto" class="form-control" id="gambar" placeholder="Ganti gambar" name="gambar" onchange="validateImg(this)" aria-describedby="fotoFeedback">
                                            <div id="fotoFeedback" class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12 text-dark" for="nohp">No HP</label>
                                    <div class="col-md-12">
                                        <input type="text" id="nohp" value="<?= $result1['NoHP']; ?>" placeholder="Masukkan No HP" class="form-control form-control-line" name="nohp" maxlength="15">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 text-dark" for="tgllahir">Tanggal Lahir</label>
                                    <div class="col-md-12">
                                        <input type="date" id="tgllahir" value="<?= $result1['Tanggal_lahir']; ?>" name="tgllahir" class="form-control form-control-line">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 text-dark" for="tmplahir">Tempat Lahir</label>
                                    <div class="col-md-12">
                                        <input type="text" id="tmplahir" placeholder="Masukkan Tempat Lahir" class="form-control form-control-line" value="<?= $result1['Tempat_lahir']; ?>" name="tmplahir" maxlength="100">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 text-dark" for="alamat">Alamat</label>
                                    <div class="col-md-12">
                                        <input type="text" id="alamat" placeholder="Masukkan Alamat Tempat Tinggal" class="form-control form-control-line" value="<?= $result1['Alamat']; ?>" name="alamat" maxlength="100">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" id="update" name="edit" class="btn btn-success text-white">Update Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <script>
                        // $('#update').on('click', function() {
                        //     let data = document.getElementById('update');

                        //     data.disabled = true;
                        //     data.innerHTML = `
                        //     <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        //     Loading...`;
                        // });
                    </script>



                </div>
                <!-- Column -->
            </div>


            <script>
                $(document).ready(function() {
                    $('#passlama').on('keyup', function() {
                        let passlama = document.getElementById('passlama').value;
                        let password = document.getElementById('password').value;
                        let passkon = document.getElementById('passkon').value;
                        let submit = document.getElementById('submit');


                        if (passlama == "" || password == "" || passkon == "") {
                            submit.disabled = true;
                        } else {
                            submit.disabled = false;
                        }
                    })

                    $('#password').on('keyup', function() {
                        let passlama = document.getElementById('passlama').value;
                        let password = document.getElementById('password').value;
                        let passkon = document.getElementById('passkon').value;
                        let submit = document.getElementById('submit');


                        if (passlama == "" || password == "" || passkon == "") {
                            submit.disabled = true;
                        } else {
                            submit.disabled = false;
                        }
                    })

                    $('#passkon').on('keyup', function() {
                        let passlama = document.getElementById('passlama').value;
                        let password = document.getElementById('password').value;
                        let passkon = document.getElementById('passkon').value;
                        let submit = document.getElementById('submit');


                        if (passlama == "" || password == "" || passkon == "") {
                            submit.disabled = true;
                        } else {
                            submit.disabled = false;
                        }
                    })
                });
            </script>
            <!-- Row -->
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->




        <script>
            $(document).ready(function() {
                $('#passkon').on('keyup', function() {
                    let pass = $('#password').val();
                    let passkon = $('#passkon').val();
                    let submit = document.getElementById('submit');

                    if (passkon != pass) {
                        $('#passkon').addClass("is-invalid");
                        submit.disabled = true;
                    } else {
                        submit.disabled = false;
                        $('#passkon').removeClass("is-invalid");
                    }
                });
                $('#password').on('keyup', function() {
                    let pass = $('#password').val();
                    let passkon = $('#passkon').val();
                    let submit = document.getElementById('submit');

                    if (passkon != "") {
                        if (passkon != pass) {
                            submit.disabled = true;
                            $('#passkon').addClass("is-invalid");
                        } else {
                            submit.disabled = false;
                            $('#passkon').removeClass("is-invalid");
                        }
                    }
                });
            });
        </script>

        <script>
            function validateImg(input) {
                const image = input.files[0].type.indexOf("image");
                const fileSize = input.files[0].size;

                let foto = document.getElementById('foto');
                let submit = document.getElementById('update');
                let pesan = document.getElementById('fotoFeedback');

                if (image == 0) {
                    if (fileSize > 1000000) {
                        foto.classList.add('is-invalid');
                        submit.disabled = true;
                        pesan.innerHTML = "Size gambar harus dibawah 1000 KiB";
                    } else {
                        foto.classList.remove('is-invalid');
                        submit.disabled = false;
                    }
                } else {
                    foto.classList.add('is-invalid');
                    pesan.innerHTML = 'Inputan bukan gambar!';
                    submit.disabled = true;
                }
            }
        </script>
        <?php include 'footer.php'; ?>