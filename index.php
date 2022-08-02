<?php
include 'controller/config.php';
session_start();



if (isset($_SESSION['id'])) {
    $login = true;

    $kode = $_SESSION['id'];
    date_default_timezone_set('Asia/Jakarta');
    $now = date("Y-m-d H-i-s");
    $insert = mysqli_query($conn, "UPDATE auth SET Last_login='$now' WHERE Kode_petugas='$kode'");
} else {
    $login = false;
}

?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Simitra</title>
    <!-- Custom CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="public/css/style.min.css" rel="stylesheet">
    <script src="public/js/sweetalert.min.js"></script>
    <script src="https://kit.fontawesome.com/a341d667ca.js" crossorigin="anonymous"></script>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="icon" type="image/png" sizes="32x32" href="public/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="public/logo.png">
    <link rel="manifest" href="public/assets/assets/img/favicons/manifest.json">
    <!-- <meta name="theme-color" content="#ffffff"> -->

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="public/assets/assets/css/theme.css" rel="stylesheet" />

    <style>
        @media only screen and (max-width: 993px) {
            ::-webkit-scrollbar {
                width: 5px;
                background-color: #ffffff;
            }
        }

        @media only screen and (max-width: 575px) {
            .to-center {
                text-align: center;
            }
        }
    </style>


</head>


<body id="home">


    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <nav class="navbar navbar-expand-lg navbar-light sticky-top" data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container"><a class="navbar-brand fw-bold" href="" style="color: black;"><img src="public/logo.png" height="31" alt="logo" style="margin-right: 10px;" /> Simitra</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
                <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="#home">Home</a></li>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="#fitur">Fitur</a></li>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="#contact">Contact Us</a></li>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="#ourteam">Our Team</a></li>
                    </ul>
                    <?php if ($login) : ?>
                        <div class='d-flex ms-lg-4'><a class='btn btn-secondary-outline' href='page/index.php'>Dashboard</a><a class='btn btn-link ms-3' href='logout.php' style='text-decoration: none;'>Logout</a></div>
                    <?php else : ?>
                        <div class='d-flex ms-lg-4'><a class='btn btn-secondary-outline' href='page/login.php'>Sign In</a><a class='btn btn-primary ms-3' href='page/login.php'>Sign Up</a></div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
        <section class="pt-7">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-md-start text-center py-6 order-sm-2 order-md-1 order-2 order-lg-1">
                        <h1 class="mb-4 fs-9 fw-bold">Ayo Daftarkan Rumah Anda Sekarang Juga!</h1>
                        <p class="mb-6 lead text-secondary">Dengan adanya aplikasi ini akan mempermudah <br class="d-none d-xl-block" />petugas dalam mendata bangunan penduduk secara <br class="d-none d-xl-block" />
                            <span class="text-success">online</span> kapanpun dan dimanapun anda berada.
                        </p>
                        <div class="text-center text-md-start">
                            <?php if ($login) : ?>
                                <a class='btn btn-primary me-3 btn-lg' href='page/index.php' role='button'>Dashboard &raquo;</a>
                            <?php else : ?>
                                <a class='btn btn-primary me-3 btn-lg' href='page/login.php' role='button'><i class='fa-solid fa-file-lines' style='margin-right: 10px;'></i> Daftar Sekarang</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6 text-end order-sm-1 order-md-2 order-1 order-lg-2"><img class="pt-7 pt-md-0 img-fluid" src="public/img/bg/remote-team.png" alt="" /></div>
                </div>
            </div>
        </section>


        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="pt-5 pt-md-9 mb-6" id="fitur">

            <div class="bg-holder z-index--1 bottom-0  d-sm-block" style="background-image:url(public/img/bg/background.webp);opacity:.5;">
            </div>
            <!--/.bg-holder-->

            <div class="container">
                <h1 class="fs-9 fw-bold mb-4 text-center">Dilengkapi dengan fitur yang berguna <br class="d-none d-xl-block" />untuk membantu anda</h1>
                <div class="row text-center mb-3">
                    <div class="col-lg-3 col-sm-6 mb-2"> <img class="mb-3 ms-n3" src="public/assets/assets/img/category/icon1.png" width="75" alt="Feature" />
                        <h4 class="mb-3">One Click</h4>
                        <p class="mb-0 fw-medium text-secondary">Daftarkan bangunan anda dengan sekali klik,</p>
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-2"> <img class="mb-3 ms-n3" src="public/assets/assets/img/category/icon2.png" width="75" alt="Feature" />
                        <h4 class="mb-3">Inovative Design</h4>
                        <p class="mb-0 fw-medium text-secondary">Design yang friendly dengan penggunaan Bootstrap dan Materialize,</p>
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-2"> <img class="mb-3 ms-n3" src="public/assets/assets/img/category/icon3.png" width="75" alt="Feature" />
                        <h4 class="mb-3">Room Chat</h4>
                        <p class="mb-0 fw-medium text-secondary">Dilengkapi dengan fitur chattingan,</p>
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-2"> <img class="mb-3 ms-n3" src="public/assets/assets/img/category/icon4.png" width="75" alt="Feature" />
                        <h4 class="mb-3">Dynamic UI and UX</h4>
                        <p class="mb-0 fw-medium text-secondary"><i>User Interface</i> dan <i>User Experience</i> yang dinamis terhadap perubahan data.</p>
                    </div>
                </div>
                <?php if (!$login) : ?>
                    <div class='text-center'><a class='btn btn-primary' href='page/login.php' role='button'><i class='fa-solid fa-file-lines' style='margin-right:10px;'></i>DAFTAR SEKARANG</a></div>
                <?php endif; ?>
            </div><!-- end of .container-->

        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->




        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="pt-5 to-center" id="about">

            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="text-secondary">Mempermudah Karyawan</h5>
                        <h2 class="mb-2 fs-7 fw-bold">Badan Pusat Statistik</h2>
                        <p class="mb-4 fw-medium text-secondary">
                            Sangat membantu karyawan untuk melakukan pendataan bangunan penduduk secara realtime.
                        </p>
                        <h4 class="fs-1 fw-bold">One Click</h4>
                        <p class="mb-4 fw-medium text-secondary">Dengan oneclick akan mempercepat segala proses online.</p>
                        <h4 class="fs-1 fw-bold">Room Chat</h4>
                        <p class="mb-4 fw-medium text-secondary">Berkomunikasi bersama menjadi lebih mudah.</p>
                        <h4 class="fs-1 fw-bold">Dynamic UI and UX</h4>
                        <p class="mb-4 fw-medium text-secondary">Desain yang dinamis terhadap perubahan data!</p>
                    </div>
                    <div class="col-lg-6"><img class="img-fluid" src="public/img/bg/crowdfunding.png" alt="" /></div>
                </div>
            </div><!-- end of .container-->

        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->




        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="pt-5 to-center" id="mahasiswa">

            <div class="container">
                <div class="row">
                    <div class="col-lg-6 order-lg-2 order-md-1">
                        <h5 class="text-secondary">Memberi hal baik dengan</h5>
                        <p class="fs-7 fw-bold mb-2">Kreatifitas Mahasiswa</p>
                        <p class="mb-4 fw-medium text-secondary">
                            Diharapkan dapat memberi dukungan ataupun semangat kepada mahasiswa lain dengan hadirnya perkembangan ilmu komputer, sehingga tidak perlu khawatir terhadap :
                        </p>
                        <div class="text-start">
                            <div class="d-flex align-items-center mb-3"> <img class="me-sm-4 me-2" src="public/assets/assets/img/manager/tick.png" width="35" alt="tick" />
                                <p class="fw-medium mb-0 text-secondary">Susah membuat coding</p>
                            </div>
                            <div class="d-flex align-items-center mb-3"> <img class="me-sm-4 me-2" src="public/assets/assets/img/manager/tick.png" width="35" alt="tick" />
                                <p class="fw-medium mb-0 text-secondary">Tidak bisa merancang desain</p>
                            </div>
                            <div class="d-flex align-items-center mb-3"><img class="me-sm-4 me-2" src="public/assets/assets/img/manager/tick.png" width="35" alt="tick" />
                                <p class="fw-medium mb-0 text-secondary">Dan tidak takut akan perubahan perkembangan yang pesat!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-1 order-md-2" id="picmahasiswa2"><img class="img-fluid" src="public/img/bg/agriculture-1.png" alt="" /></div>
                </div>
            </div><!-- end of .container-->

        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->



        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="pt-5 to-center" id="marketer">

            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="text-secondary">Dukungan awal untuk negara</h5>
                        <p class="mb-2 fs-8 fw-bold">Pemerintahan</p>
                        <p class="mb-4 fw-medium text-secondary">Sebagai langkah awal untuk perubahan industri teknologi di Indonesia! Pendataan penduduk yang diharapkan menjadi suatu langkah ideal untuk Indonesia.</p>
                        <h4 class="fw-bold fs-1">Pemberi Keputusan yang Handal</h4>
                        <p class="mb-4 fw-medium text-secondary">Memberi keputusan yang tepat dengan harapan mendapat hasil yang bermanfaat</p>
                        <h4 class="fw-bold fs-1">Upgrade dari Hal Lama</h4>
                        <p class="mb-4 fw-medium text-secondary">Perkembangan teknologi membuat segala aktivitas dahulu menjadi lebih modern dan praktis </p>
                        <h4 class="fw-bold fs-1">Pendataan yang Idealis</h4>
                        <p class="mb-4 fw-medium text-secondary">Data yang disajikan mudah diproses dan diolah dengan cepat</p>
                    </div>
                    <div class="col-lg-6"><img class="img-fluid" src="public/img/bg/task.png" alt="" /></div>
                </div>
            </div><!-- end of .container-->

        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->
        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="py-md-11 py-8" id="contact">
            <div class="bg-holder z-index--1 bottom-0 d-sm-block background-position-top" style="background-image:url(public/img/bg/background.webp);opacity:.5; background-position: top !important ;">
            </div>
            <!--/.bg-holder-->

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h1 class="fw-bold mb-4 fs-7">Butuh Bantuan?</h1>
                        <p class="mb-5 text-info fw-medium">Bantuan apapun terkait website simitra dapat ditanyakan langsung sekarang juga!</p>
                        <a class="btn btn-primary btn-md" href="mailto:polah3bps@gmail.com"><i class="fa-solid fa-envelope" style="margin-right: 10px;"></i> Contact Us</a>
                    </div>
                </div>
            </div><!-- end of .container-->

        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->
        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="pt-5" id="ourteam">

            <div class="container text-center">
                <h1 class="fw-bold fs-6 mb-3">OUR TEAM</h1>
                <p class="mb-6 text-secondary">Introducing Our Team</p>
                <div class="row mx-auto">
                    <div class="col-md-2"></div>
                    <div class="col-md-4 mb-4">
                        <div class="card"><img class="card-img-top rounded-circle" src="public/img/programmer/profil-rizqillah.jpg" alt="Profil" height="180" style="width: 200px; margin: auto;" />
                            <div class="card-body ps-0">
                                <!-- <p class="text-secondary">By <a class="fw-bold text-decoration-none me-1" href="#">Abdullah</a>|<span class="ms-1">03 March 2019</span></p> -->
                                <a href="https://github.com/rizqillah-pnl/" target="_blank" class="text-decoration-none">
                                    <h3 class="fw-bold">RIZQILLAH</h3>
                                </a>
                                <div class="card-subtitle">Programmer | Designer | Creator</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card"><img class="card-img-top rounded-circle" src="public/img/programmer/ila.jpg" alt="Profil" height="180" style="width: 200px; margin: auto" />
                            <div class="card-body ps-0">
                                <!-- <p class="text-secondary">By <a class="fw-bold text-decoration-none me-1" href="#">Abdullah</a>|<span class="ms-1">03 March 2019</span></p> -->
                                <a href="https://github.com/rahmainisarii" target="_blank" class="text-decoration-none">
                                    <h3 class="fw-bold">RAHMAINI SALSABILA SARI</h3>
                                </a>
                                <div class="card-subtitle">Designer</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div><!-- end of .container-->

        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->
        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="pb-2 pb-lg-5">

            <div class="container">
                <div class="row border-top border-top-secondary pt-7 text-center justify-content-center">
                    <div class="col-lg-1 col-md-2 mb-2 mb-md-2 mb-lg-0 mb-sm-2 order-1 order-md-1 order-lg-1 fw-bold d-md-none d-lg-inline" style="font-size: 30px; "><img class="mb-4" src="public/logo.png" width="70" alt="" /></div>
                    <div class="col-lg-2 col-md-6 mb-4 mb-md-6 mb-lg-0 mb-sm-2 order-1 order-md-1 order-lg-1 fw-bold" style="font-size: 30px; ">Simitra</div>
                    <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 order-2 order-md-3 order-lg-2">
                        <p class="fs-2 mb-lg-4">Quick Links</p>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1"><a class="link-900 text-secondary text-decoration-none" href="#home">Home</a></li>
                            <li class="mb-1"><a class="link-900 text-secondary text-decoration-none" href="#fitur">Fitur</a></li>
                            <li class="mb-1"><a class="link-900 text-secondary text-decoration-none" href="#about">About</a></li>
                            <li class="mb-1"><a class="link-900 text-secondary text-decoration-none" href="#contact">Contact Us</a></li>
                            <li class="mb-1"><a class="link-900 text-secondary text-decoration-none" href="#ourteam">Our Team</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 order-3 order-md-4 order-lg-3">
                        <p class="fs-2 mb-lg-4">Legal Stuff</p>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1"><a class="link-900 text-secondary text-decoration-none" href="#!">Disclaimer</a></li>
                            <li class="mb-1"><a class="link-900 text-secondary text-decoration-none" href="#!">Financing</a></li>
                            <li class="mb-1"><a class="link-900 text-secondary text-decoration-none" href="#!">Privacy Policy</a></li>
                            <li class="mb-1"><a class="link-900 text-secondary text-decoration-none" href="#!">Terms of Service</a></li>
                        </ul>
                    </div>
                </div>
            </div><!-- end of .container-->

        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->
        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="text-center py-0">

            <div class="container">
                <div class="container border-top py-3">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-auto mb-1 mb-md-0">
                            <p class="mb-0">&copy; 2022 <a href="index.php" class="text-decoration-none ms-1">Simitra</a> </p>
                        </div>
                        <div class="col-12 col-md-auto">
                            <p class="mb-0">
                                Made
                                with<span class="fas fa-heart mx-1 text-danger"> </span>by
                                <a class="text-decoration-none ms-1" href="https://themewagon.com/" target="_blank">ThemeWagon</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div><!-- end of .container-->
        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->


    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="public/assets/vendors/@popperjs/popper.min.js"></script>
    <script src="public/assets/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="public/assets/vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="public/assets/vendors/fontawesome/all.min.js"></script>
    <script src="public/assets/assets/js/theme.js"></script>

</body>

</html>